import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../providers/proposal_provider.dart';
import '../models/proposal.dart';

class ProposalFormScreen extends StatefulWidget {
  final Function(String) onSubmissionSuccess;

  const ProposalFormScreen({Key? key, required this.onSubmissionSuccess}) : super(key: key);

  @override
  _ProposalFormScreenState createState() => _ProposalFormScreenState();
}

class _ProposalFormScreenState extends State<ProposalFormScreen> {
  final _formKey = GlobalKey<FormState>();

  final _clientNameController = TextEditingController();
  final _emailController = TextEditingController();
  final _phoneController = TextEditingController();
  final _streetController = TextEditingController();
  final _street2Controller = TextEditingController();
  final _cityController = TextEditingController();
  final _provinceController = TextEditingController();
  final _postalController = TextEditingController();
  final _descController = TextEditingController();

  String _phoneCountryCode = '+62';

  @override
  void dispose() {
    _clientNameController.dispose();
    _emailController.dispose();
    _phoneController.dispose();
    _streetController.dispose();
    _street2Controller.dispose();
    _cityController.dispose();
    _provinceController.dispose();
    _postalController.dispose();
    _descController.dispose();
    super.dispose();
  }

  void _submitForm() async {
    if (!_formKey.currentState!.validate()) return;

    final provider = Provider.of<ProposalProvider>(context, listen: false);

    final payload = {
      'client_name': _clientNameController.text.trim(),
      'email': _emailController.text.trim(),
      'phone_country_code': _phoneCountryCode,
      'phone_number': _phoneController.text.trim(),
      'address_street': _streetController.text.trim(),
      'address_street2': _street2Controller.text.trim().isEmpty ? null : _street2Controller.text.trim(),
      'address_city': _cityController.text.trim(),
      'address_province': _provinceController.text.trim(),
      'address_postal': _postalController.text.trim(),
      'project_description': _descController.text.trim().isEmpty ? null : _descController.text.trim(),
    };

    final Proposal? result = await provider.submitProposal(payload);

    if (result != null) {
      _formKey.currentState!.reset();
      _descController.clear();
      
      // Show success modal
      showDialog(
        context: context,
        barrierDismissible: false,
        builder: (ctx) => AlertDialog(
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
          title: Row(
            children: const [
              Icon(Icons.check_circle, color: Colors.green, size: 28),
              SizedBox(width: 10),
              Text('Pengajuan Sukses!', style: TextStyle(fontWeight: FontWeight.bold)),
            ],
          ),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const Text('Proposal penawaran Anda berhasil disimpan. Gunakan kode keamanan di bawah untuk melacak status proyek Anda:'),
              const SizedBox(height: 15),
              Container(
                width: double.infinity,
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: Colors.blue.shade50,
                  borderRadius: BorderRadius.circular(8),
                  border: Border.all(color: Colors.blue.shade200),
                ),
                child: Center(
                  child: SelectableText(
                    result.proposalCode,
                    style: TextStyle(
                      fontSize: 20,
                      fontWeight: FontWeight.bold,
                      color: Colors.blue.shade900,
                      letterSpacing: 1,
                    ),
                  ),
                ),
              ),
            ],
          ),
          actions: [
            TextButton(
              onPressed: () {
                Navigator.of(ctx).pop();
                widget.onSubmissionSuccess(result.proposalCode);
              },
              child: const Text('Lacak Sekarang', style: TextStyle(fontWeight: FontWeight.bold)),
            ),
          ],
        ),
      );
    } else {
      // Show error toast/snack
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text(provider.errorMessage ?? 'Gagal mengirim penawaran.'),
          backgroundColor: Colors.red.shade700,
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    final isLoading = context.watch<ProposalProvider>().isLoading;

    return Scaffold(
      appBar: AppBar(
        title: const Text('Ajukan Penawaran Desain Web', style: TextStyle(fontWeight: FontWeight.bold, color: Colors.white)),
        backgroundColor: const Color(0xFF00236f),
        elevation: 0,
      ),
      body: Stack(
        children: [
          SingleChildScrollView(
            padding: const EdgeInsets.all(16.0),
            child: Form(
              key: _formKey,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const Text(
                    'Formulir Pengajuan Penawaran',
                    style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold, color: Color(0xFF00236f)),
                  ),
                  const SizedBox(height: 5),
                  const Text(
                    'Isi informasi diri dan detail kebutuhan website Anda dengan lengkap.',
                    style: TextStyle(fontSize: 12, color: Colors.grey),
                  ),
                  const SizedBox(height: 20),

                  // Client Name
                  _buildSectionTitle('Data Diri Klien'),
                  const SizedBox(height: 10),
                  _buildTextField(
                    controller: _clientNameController,
                    label: 'Nama Lengkap Klien / Instansi',
                    icon: Icons.person,
                    validator: (val) => val == null || val.isEmpty ? 'Nama wajib diisi' : null,
                  ),
                  const SizedBox(height: 12),

                  // Email
                  _buildTextField(
                    controller: _emailController,
                    label: 'Alamat Email Aktif',
                    icon: Icons.email,
                    keyboardType: TextInputType.emailAddress,
                    validator: (val) {
                      if (val == null || val.isEmpty) return 'Email wajib diisi';
                      if (!RegExp(r'^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$').hasMatch(val)) return 'Format email tidak valid';
                      return null;
                    },
                  ),
                  const SizedBox(height: 12),

                  // Phone Number
                  Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Container(
                        width: 100,
                        padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                        decoration: BoxDecoration(
                          border: Border.all(color: Colors.grey.shade400),
                          borderRadius: BorderRadius.circular(8),
                          color: Colors.white,
                        ),
                        child: DropdownButtonHideUnderline(
                          child: DropdownButton<String>(
                            value: _phoneCountryCode,
                            isExpanded: true,
                            items: const [
                              DropdownMenuItem(value: '+62', child: Text('🇮🇩 +62')),
                              DropdownMenuItem(value: '+65', child: Text('🇸🇬 +65')),
                              DropdownMenuItem(value: '+60', child: Text('🇲🇾 +60')),
                              DropdownMenuItem(value: '+1', child: Text('🇺🇸 +1')),
                            ],
                            onChanged: (val) {
                              if (val != null) {
                                setState(() {
                                  _phoneCountryCode = val;
                                });
                              }
                            },
                          ),
                        ),
                      ),
                      const SizedBox(width: 10),
                      Expanded(
                        child: _buildTextField(
                          controller: _phoneController,
                          label: 'Nomor Telepon',
                          icon: Icons.phone,
                          keyboardType: TextInputType.phone,
                          validator: (val) {
                            if (val == null || val.isEmpty) return 'No. Telepon wajib diisi';
                            if (val.length < 8) return 'Terlalu pendek';
                            return null;
                          },
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 20),

                  // Address
                  _buildSectionTitle('Alamat Lengkap'),
                  const SizedBox(height: 10),
                  _buildTextField(
                    controller: _streetController,
                    label: 'Nama Jalan / Gedung / RT RW',
                    icon: Icons.map,
                    validator: (val) => val == null || val.isEmpty ? 'Jalan wajib diisi' : null,
                  ),
                  const SizedBox(height: 12),
                  _buildTextField(
                    controller: _street2Controller,
                    label: 'Detail Alamat Tambahan (Opsional)',
                    icon: Icons.location_city,
                  ),
                  const SizedBox(height: 12),
                  Row(
                    children: [
                      Expanded(
                        child: _buildTextField(
                          controller: _cityController,
                          label: 'Kabupaten / Kota',
                          validator: (val) => val == null || val.isEmpty ? 'Kota wajib' : null,
                        ),
                      ),
                      const SizedBox(width: 10),
                      Expanded(
                        child: _buildTextField(
                          controller: _provinceController,
                          label: 'Provinsi',
                          validator: (val) => val == null || val.isEmpty ? 'Provinsi wajib' : null,
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 12),
                  _buildTextField(
                    controller: _postalController,
                    label: 'Kode Pos',
                    keyboardType: TextInputType.number,
                    validator: (val) {
                      if (val == null || val.isEmpty) return 'Kode pos wajib';
                      if (val.length != 5 || int.tryParse(val) == null) return 'Harus 5 digit angka';
                      return null;
                    },
                  ),
                  const SizedBox(height: 20),

                  // Project Description
                  _buildSectionTitle('Kebutuhan Proyek'),
                  const SizedBox(height: 10),
                  _buildTextField(
                    controller: _descController,
                    label: 'Jelaskan Desain Web yang Anda inginkan',
                    maxLines: 4,
                  ),
                  const SizedBox(height: 30),

                  // Submit Button
                  SizedBox(
                    width: double.infinity,
                    height: 50,
                    child: ElevatedButton(
                      onPressed: isLoading ? null : _submitForm,
                      style: ElevatedButton.styleFrom(
                        backgroundColor: const Color(0xFF0058be),
                        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                        elevation: 2,
                      ),
                      child: const Text(
                        'Kirim Penawaran',
                        style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: Colors.white),
                      ),
                    ),
                  ),
                  const SizedBox(height: 20),
                ],
              ),
            ),
          ),
          if (isLoading)
            Container(
              color: Colors.black.withOpacity(0.2),
              child: const Center(
                child: CircularProgressIndicator(color: Color(0xFF00236f)),
              ),
            ),
        ],
      ),
    );
  }

  Widget _buildSectionTitle(String title) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          title,
          style: const TextStyle(fontSize: 14, fontWeight: FontWeight.bold, color: Color(0xFF00236f)),
        ),
        const SizedBox(height: 4),
        const Divider(height: 1),
      ],
    );
  }

  Widget _buildTextField({
    required TextEditingController controller,
    required String label,
    IconData? icon,
    TextInputType keyboardType = TextInputType.text,
    int maxLines = 1,
    String? Function(String?)? validator,
  }) {
    return TextFormField(
      controller: controller,
      keyboardType: keyboardType,
      maxLines: maxLines,
      validator: validator,
      decoration: InputDecoration(
        labelText: label,
        prefixIcon: icon != null ? Icon(icon, color: Colors.grey.shade600) : null,
        filled: true,
        fillColor: Colors.white,
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(8),
          borderSide: BorderSide(color: Colors.grey.shade400),
        ),
        enabledBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(8),
          borderSide: BorderSide(color: Colors.grey.shade300),
        ),
        focusedBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(8),
          borderSide: const BorderSide(color: Color(0xFF0058be), width: 2),
        ),
        contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
      ),
    );
  }
}
