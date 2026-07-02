import 'dart:convert';
import 'package:flutter/foundation.dart' show kIsWeb;
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import '../models/proposal.dart';

class ProposalProvider with ChangeNotifier {
  // Automatically adjust base URL based on platform/web runtime
  String _baseUrl = kIsWeb ? 'http://localhost:8000/api' : 'http://10.0.2.2:8000/api';
  
  bool _isLoading = false;
  Proposal? _trackedProposal;
  String? _errorMessage;
  List<Map<String, String>> _recentProposals = [];

  // Mobile Admin State
  bool _isMobileAdminLoggedIn = false;
  List<Proposal> _allProposals = [];

  bool get isLoading => _isLoading;
  Proposal? get trackedProposal => _trackedProposal;
  String? get errorMessage => _errorMessage;
  List<Map<String, String>> get recentProposals => _recentProposals;

  bool get isMobileAdminLoggedIn => _isMobileAdminLoggedIn;
  List<Proposal> get allProposals => _allProposals;

  ProposalProvider() {
    // If running in browser web, ensure localhost is used
    if (kIsWeb) {
      _baseUrl = 'http://localhost:8000/api';
    }
  }

  void updateBaseUrl(String newUrl) {
    _baseUrl = newUrl;
    notifyListeners();
  }

  // Mobile Admin login action
  Future<bool> loginMobileAdmin(String username, String password) async {
    _isLoading = true;
    _errorMessage = null;
    notifyListeners();

    await Future.delayed(const Duration(milliseconds: 1000)); // aesthetic delay

    if (username.trim() == 'admin' && password.trim() == 'admin') {
      _isMobileAdminLoggedIn = true;
      _isLoading = false;
      notifyListeners();
      await fetchAllProposals();
      return true;
    }

    _errorMessage = 'Username atau password salah.';
    _isLoading = false;
    notifyListeners();
    return false;
  }

  void logoutMobileAdmin() {
    _isMobileAdminLoggedIn = false;
    _allProposals = [];
    notifyListeners();
  }

  Future<void> fetchAllProposals() async {
    _isLoading = true;
    notifyListeners();

    try {
      final response = await http.get(
        Uri.parse('$_baseUrl/proposals'),
        headers: {
          'Accept': 'application/json'
        }
      );

      final Map<String, dynamic> responseData = jsonDecode(response.body);

      if (response.statusCode == 200 && responseData['success'] == true) {
        final List<dynamic> list = responseData['data'];
        _allProposals = list.map((item) => Proposal.fromJson(item)).toList();
      } else {
        _errorMessage = responseData['message'] ?? 'Gagal memuat daftar proposal.';
      }
    } catch (e) {
      _errorMessage = 'Koneksi database Laravel gagal.';
      debugPrint("Fetch admin proposals error: $e");
    }

    _isLoading = false;
    notifyListeners();
  }

  Future<bool> updateProposalStatusMobile(String code, String status) async {
    try {
      final response = await http.put(
        Uri.parse('$_baseUrl/proposals/$code/status'),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: jsonEncode({'status': status})
      );

      final Map<String, dynamic> responseData = jsonDecode(response.body);

      if (response.statusCode == 200 && responseData['success'] == true) {
        // Update local copy
        final index = _allProposals.indexWhere((p) => p.proposalCode == code);
        if (index != -1) {
          final old = _allProposals[index];
          _allProposals[index] = Proposal(
            proposalCode: old.proposalCode,
            date: old.date,
            clientName: old.clientName,
            email: old.email,
            phoneCountryCode: old.phoneCountryCode,
            phoneNumber: old.phoneNumber,
            addressStreet: old.addressStreet,
            addressStreet2: old.addressStreet2,
            addressCity: old.addressCity,
            addressProvince: old.addressProvince,
            addressPostal: old.addressPostal,
            projectDescription: old.projectDescription,
            status: status
          );
        }
        notifyListeners();
        return true;
      }
    } catch (e) {
      debugPrint("Update status error: $e");
    }
    return false;
  }

  Future<bool> deleteProposalMobile(String code) async {
    try {
      final response = await http.delete(
        Uri.parse('$_baseUrl/proposals/$code'),
        headers: {
          'Accept': 'application/json'
        }
      );

      final Map<String, dynamic> responseData = jsonDecode(response.body);

      if (response.statusCode == 200 && responseData['success'] == true) {
        _allProposals.removeWhere((p) => p.proposalCode == code);
        notifyListeners();
        return true;
      }
    } catch (e) {
      debugPrint("Delete error: $e");
    }
    return false;
  }

  Future<void> loadRecentProposals() async {
    try {
      final prefs = await SharedPreferences.getInstance();
      final String? cachedData = prefs.getString('recent_proposals_data');
      if (cachedData != null) {
        final List<dynamic> decoded = jsonDecode(cachedData);
        _recentProposals = decoded.map((item) => {
          'code': item['code'].toString(),
          'clientName': item['clientName'].toString(),
          'date': item['date'].toString()
        }).toList();
        notifyListeners();
      }
    } catch (e) {
      debugPrint("Failed to load recent proposals: $e");
    }
  }

  Future<void> saveRecentProposal(String code, String clientName, String date) async {
    try {
      final prefs = await SharedPreferences.getInstance();
      _recentProposals.removeWhere((p) => p['code'] == code);
      
      _recentProposals.insert(0, {
        'code': code,
        'clientName': clientName,
        'date': date
      });
      
      if (_recentProposals.length > 5) {
        _recentProposals.removeLast();
      }

      await prefs.setString('recent_proposals_data', jsonEncode(_recentProposals));
      notifyListeners();
    } catch (e) {
      debugPrint("Failed to save recent proposal: $e");
    }
  }

  Future<Proposal?> submitProposal(Map<String, dynamic> data) async {
    _isLoading = true;
    _errorMessage = null;
    notifyListeners();

    try {
      final response = await http.post(
        Uri.parse('$_baseUrl/proposals'),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: jsonEncode(data)
      );

      final Map<String, dynamic> responseData = jsonDecode(response.body);

      if (response.statusCode == 201 && responseData['success'] == true) {
        final Proposal newProposal = Proposal.fromJson(responseData['data']);
        await saveRecentProposal(newProposal.proposalCode, newProposal.clientName, newProposal.date);
        _isLoading = false;
        notifyListeners();
        return newProposal;
      } else {
        _errorMessage = responseData['message'] ?? 'Gagal membuat proposal.';
      }
    } catch (e) {
      _errorMessage = 'Terjadi kesalahan koneksi ke server backend Laravel.';
      debugPrint("Submit error: $e");
    }

    _isLoading = false;
    notifyListeners();
    return null;
  }

  Future<bool> trackProposal(String code) async {
    _isLoading = true;
    _errorMessage = null;
    _trackedProposal = null;
    notifyListeners();

    await Future.delayed(const Duration(milliseconds: 1200));

    try {
      final response = await http.get(
        Uri.parse('$_baseUrl/proposals/$code'),
        headers: {
          'Accept': 'application/json'
        }
      );

      final Map<String, dynamic> responseData = jsonDecode(response.body);

      if (response.statusCode == 200 && responseData['success'] == true) {
        _trackedProposal = Proposal.fromJson(responseData['data']);
        _isLoading = false;
        notifyListeners();
        return true;
      } else {
        _errorMessage = responseData['message'] ?? 'Proposal tidak ditemukan.';
      }
    } catch (e) {
      _errorMessage = 'Gagal memuat data dari server. Periksa koneksi Anda.';
      debugPrint("Track error: $e");
    }

    _isLoading = false;
    notifyListeners();
    return false;
  }
}
