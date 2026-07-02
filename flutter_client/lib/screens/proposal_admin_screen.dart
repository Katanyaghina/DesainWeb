import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../providers/proposal_provider.dart';
import '../models/proposal.dart';

class ProposalAdminScreen extends StatefulWidget {
  const ProposalAdminScreen({Key? key}) : super(key: key);

  @override
  _ProposalAdminScreenState createState() => _ProposalAdminScreenState();
}

class _ProposalAdminScreenState extends State<ProposalAdminScreen> {
  final _usernameController = TextEditingController();
  final _passwordController = TextEditingController();
  final _loginFormKey = GlobalKey<FormState>();

  @override
  void dispose() {
    _usernameController.dispose();
    _passwordController.dispose();
    super.dispose();
  }

  void _handleLogin() async {
    if (!_loginFormKey.currentState!.validate()) return;
    
    final provider = Provider.of<ProposalProvider>(context, listen: false);
    final success = await provider.loginMobileAdmin(
      _usernameController.text,
      _passwordController.text,
    );

    if (success) {
      _usernameController.clear();
      _passwordController.clear();
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Login berhasil! Selamat datang Admin.'), backgroundColor: Colors.green),
      );
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text(provider.errorMessage ?? 'Gagal login.'), backgroundColor: Colors.red),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    final provider = context.watch<ProposalProvider>();
    final isLoggedIn = provider.isMobileAdminLoggedIn;
    final isLoading = provider.isLoading;

    if (!isLoggedIn) {
      return Scaffold(
        backgroundColor: const Color(0xFFf7f9fb), // Light aesthetic
        body: Center(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(24.0),
            child: Form(
              key: _loginFormKey,
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const Text(
                    'sign in',
                    style: TextStyle(
                      color: Colors.grey,
                      fontWeight: FontWeight.bold,
                      letterSpacing: 2,
                      fontSize: 12,
                    ),
                  ),
                  const SizedBox(height: 16),
                  
                  // Card login (Light mode)
                  Container(
                    padding: const EdgeInsets.all(24),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(15),
                      border: Border.all(color: Colors.grey.shade300),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black.withOpacity(0.04),
                          blurRadius: 10,
                          offset: const Offset(0, 4),
                        ),
                      ],
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        const Text(
                          'Admin Login',
                          style: TextStyle(
                            color: Color(0xFF00236f),
                            fontSize: 22,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        const SizedBox(height: 24),

                        // Username input
                        const Text(
                          'USERNAME OR EMAIL',
                          style: TextStyle(color: Colors.grey, fontSize: 10, fontWeight: FontWeight.bold),
                        ),
                        const SizedBox(height: 6),
                        TextFormField(
                          controller: _usernameController,
                          style: const TextStyle(color: Colors.black87, fontSize: 14),
                          validator: (val) => val == null || val.isEmpty ? 'Username wajib' : null,
                          decoration: InputDecoration(
                            hintText: 'Enter your username',
                            hintStyle: const TextStyle(color: Colors.grey),
                            prefixIcon: const Icon(Icons.person, color: Colors.grey),
                            filled: true,
                            fillColor: Colors.grey.shade50,
                            border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(8),
                              borderSide: BorderSide(color: Colors.grey.shade300),
                            ),
                            enabledBorder: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(8),
                              borderSide: BorderSide(color: Colors.grey.shade300),
                            ),
                          ),
                        ),
                        const SizedBox(height: 16),

                        // Password input
                        const Text(
                          'PASSWORD',
                          style: TextStyle(color: Colors.grey, fontSize: 10, fontWeight: FontWeight.bold),
                        ),
                        const SizedBox(height: 6),
                        TextFormField(
                          controller: _passwordController,
                          obscureText: true,
                          style: const TextStyle(color: Colors.black87, fontSize: 14),
                          validator: (val) => val == null || val.isEmpty ? 'Password wajib' : null,
                          decoration: InputDecoration(
                            hintText: '••••••••',
                            hintStyle: const TextStyle(color: Colors.grey),
                            prefixIcon: const Icon(Icons.lock, color: Colors.grey),
                            filled: true,
                            fillColor: Colors.grey.shade50,
                            border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(8),
                              borderSide: BorderSide(color: Colors.grey.shade300),
                            ),
                            enabledBorder: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(8),
                              borderSide: BorderSide(color: Colors.grey.shade300),
                            ),
                          ),
                        ),
                        const SizedBox(height: 24),

                        // Sign in button
                        SizedBox(
                          width: double.infinity,
                          height: 48,
                          child: ElevatedButton(
                            onPressed: isLoading ? null : _handleLogin,
                            style: ElevatedButton.styleFrom(
                              backgroundColor: const Color(0xFF0058be),
                              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                            ),
                            child: isLoading
                                ? const SizedBox(
                                    width: 20,
                                    height: 20,
                                    child: CircularProgressIndicator(color: Colors.white, strokeWidth: 2),
                                  )
                                : const Text(
                                    'Sign In Admin',
                                    style: TextStyle(fontWeight: FontWeight.bold, color: Colors.white),
                                  ),
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
      );
    }

    // Dashboard View if logged in
    final proposals = provider.allProposals;
    final total = proposals.length;
    final pending = proposals.where((p) => p.status == 'Pending').length;
    final reviewed = proposals.where((p) => p.status == 'Reviewed').length;
    final approved = proposals.where((p) => p.status == 'Approved').length;

    return Scaffold(
      appBar: AppBar(
        title: const Text('Dashboard Admin Mobile', style: TextStyle(fontWeight: FontWeight.bold, color: Colors.white)),
        backgroundColor: const Color(0xFF00236f),
        actions: [
          IconButton(
            icon: const Icon(Icons.logout, color: Colors.white),
            onPressed: () {
              provider.logoutMobileAdmin();
              ScaffoldMessenger.of(context).showSnackBar(
                const SnackBar(content: Text('Anda telah keluar dari dashboard admin.')),
              );
            },
          ),
        ],
      ),
      body: RefreshIndicator(
        onRefresh: () => provider.fetchAllProposals(),
        child: SingleChildScrollView(
          physics: const AlwaysScrollableScrollPhysics(),
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // KPI Summary Rows
              Row(
                children: [
                  _buildKpiCard('TOTAL', total.toString(), Colors.blue),
                  const SizedBox(width: 8),
                  _buildKpiCard('PENDING', pending.toString(), Colors.orange),
                ],
              ),
              const SizedBox(height: 8),
              Row(
                children: [
                  _buildKpiCard('REVIEWED', reviewed.toString(), Colors.purple),
                  const SizedBox(width: 8),
                  _buildKpiCard('APPROVED', approved.toString(), Colors.green),
                ],
              ),
              const SizedBox(height: 20),

              const Text(
                'DAFTAR PROPOSAL MASUK',
                style: TextStyle(fontSize: 12, fontWeight: FontWeight.bold, color: Colors.grey, letterSpacing: 1),
              ),
              const SizedBox(height: 8),

              if (isLoading)
                const Center(
                  child: Padding(
                    padding: EdgeInsets.all(20.0),
                    child: CircularProgressIndicator(),
                  ),
                )
              else if (proposals.isEmpty)
                const Center(
                  child: Padding(
                    padding: EdgeInsets.all(32.0),
                    child: Text('Tidak ada proposal masuk.', style: TextStyle(fontStyle: FontStyle.italic, color: Colors.grey)),
                  ),
                )
              else
                ListView.builder(
                  shrinkWrap: true,
                  physics: const NeverScrollableScrollPhysics(),
                  itemCount: proposals.length,
                  itemBuilder: (ctx, idx) {
                    final p = proposals[idx];
                    Color badgeColor = Colors.orange;
                    if (p.status == 'Reviewed') badgeColor = Colors.purple;
                    if (p.status == 'Approved') badgeColor = Colors.green;
                    if (p.status == 'Rejected') badgeColor = Colors.red;

                    return Card(
                      margin: const EdgeInsets.symmetric(vertical: 6),
                      child: ListTile(
                        title: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Text(p.proposalCode, style: const TextStyle(fontWeight: FontWeight.bold, color: Color(0xFF00236f))),
                            Container(
                              padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
                              decoration: BoxDecoration(color: badgeColor, borderRadius: BorderRadius.circular(10)),
                              child: Text(p.status, style: const TextStyle(color: Colors.white, fontSize: 10, fontWeight: FontWeight.bold)),
                            ),
                          ],
                        ),
                        subtitle: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            const SizedBox(height: 4),
                            Text(p.clientName, style: const TextStyle(fontWeight: FontWeight.w600, color: Colors.black87)),
                            Text('${p.email} • ${p.phoneCountryCode} ${p.phoneNumber}', style: const TextStyle(fontSize: 11)),
                          ],
                        ),
                        trailing: const Icon(Icons.edit, size: 18, color: Color(0xFF0058be)),
                        onTap: () => _openProposalManagementSheet(p),
                      ),
                    );
                  },
                ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildKpiCard(String label, String value, Color color) {
    return Expanded(
      child: Container(
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(10),
          border: Border.all(color: Colors.grey.shade200),
          boxShadow: [
            BoxShadow(color: Colors.black.withOpacity(0.02), blurRadius: 4, offset: const Offset(0, 2)),
          ],
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(label, style: const TextStyle(fontSize: 10, color: Colors.grey, fontWeight: FontWeight.bold)),
            const SizedBox(height: 4),
            Text(value, style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: color)),
          ],
        ),
      ),
    );
  }

  void _openProposalManagementSheet(Proposal p) {
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      shape: const RoundedRectangleBorder(borderRadius: BorderRadius.vertical(top: Radius.circular(16))),
      builder: (ctx) {
        final provider = Provider.of<ProposalProvider>(context);
        return Padding(
          padding: const EdgeInsets.all(20.0),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(p.proposalCode, style: const TextStyle(fontSize: 18, fontWeight: FontWeight.bold, color: Color(0xFF00236f))),
                  IconButton(icon: const Icon(Icons.close), onPressed: () => Navigator.pop(ctx)),
                ],
              ),
              const Divider(),
              const SizedBox(height: 10),
              
              Text('Klien: ${p.clientName}', style: const TextStyle(fontWeight: FontWeight.bold)),
              Text('Kontak: ${p.email} • ${p.phoneCountryCode} ${p.phoneNumber}'),
              const SizedBox(height: 15),

              const Text('Ubah Status Proposal:', style: TextStyle(fontWeight: FontWeight.bold, fontSize: 13, color: Colors.grey)),
              const SizedBox(height: 10),

              // Status buttons
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  _buildStatusActionButton(ctx, p.proposalCode, 'Pending', Colors.orange),
                  _buildStatusActionButton(ctx, p.proposalCode, 'Reviewed', Colors.purple),
                  _buildStatusActionButton(ctx, p.proposalCode, 'Approved', Colors.green),
                  _buildStatusActionButton(ctx, p.proposalCode, 'Rejected', Colors.red),
                ],
              ),
              const SizedBox(height: 20),

              const Divider(),
              const SizedBox(height: 10),

              // Delete button
              SizedBox(
                width: double.infinity,
                child: ElevatedButton.icon(
                  onPressed: () async {
                    final confirm = await showDialog<bool>(
                      context: ctx,
                      builder: (dCtx) => AlertDialog(
                        title: const Text('Hapus Proposal'),
                        content: Text('Apakah Anda yakin ingin menghapus proposal ${p.proposalCode}?'),
                        actions: [
                          TextButton(onPressed: () => Navigator.pop(dCtx, false), child: const Text('Batal')),
                          TextButton(onPressed: () => Navigator.pop(dCtx, true), child: const Text('Hapus', style: TextStyle(color: Colors.red))),
                        ],
                      ),
                    );

                    if (confirm == true) {
                      final success = await provider.deleteProposalMobile(p.proposalCode);
                      Navigator.pop(ctx); // Close sheet
                      if (success) {
                        ScaffoldMessenger.of(context).showSnackBar(
                          const SnackBar(content: Text('Proposal berhasil dihapus.')),
                        );
                      }
                    }
                  },
                  icon: const Icon(Icons.delete, color: Colors.white),
                  label: const Text('Hapus Proposal', style: TextStyle(fontWeight: FontWeight.bold, color: Colors.white)),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red.shade700,
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                  ),
                ),
              ),
            ],
          ),
        );
      },
    );
  }

  Widget _buildStatusActionButton(BuildContext sheetCtx, String code, String targetStatus, Color color) {
    return ElevatedButton(
      onPressed: () async {
        final success = await Provider.of<ProposalProvider>(context, listen: false)
            .updateProposalStatusMobile(code, targetStatus);
        Navigator.pop(sheetCtx); // Close bottom sheet
        if (success) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text('Status proposal diupdate ke $targetStatus.'), backgroundColor: color),
          );
        }
      },
      style: ElevatedButton.styleFrom(
        backgroundColor: color,
        padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 8),
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
      ),
      child: Text(targetStatus, style: const TextStyle(color: Colors.white, fontSize: 11, fontWeight: FontWeight.bold)),
    );
  }
}
