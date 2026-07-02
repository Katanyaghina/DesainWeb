import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:skeletonizer/skeletonizer.dart';
import '../providers/proposal_provider.dart';
import '../models/proposal.dart';

class ProposalTrackScreen extends StatefulWidget {
  final String? initialCode;

  const ProposalTrackScreen({Key? key, this.initialCode}) : super(key: key);

  @override
  _ProposalTrackScreenState createState() => _ProposalTrackScreenState();
}

class _ProposalTrackScreenState extends State<ProposalTrackScreen> {
  final _codeController = TextEditingController();

  @override
  void initState() {
    super.initState();
    if (widget.initialCode != null) {
      _codeController.text = widget.initialCode!;
      // Auto search
      WidgetsBinding.instance.addPostFrameCallback((_) {
        _searchProposal(widget.initialCode!);
      });
    }
  }

  @override
  void dispose() {
    _codeController.dispose();
    super.dispose();
  }

  void _searchProposal(String code) {
    if (code.trim().isEmpty) return;
    Provider.of<ProposalProvider>(context, listen: false).trackProposal(code.trim().toUpperCase());
  }

  @override
  Widget build(BuildContext context) {
    final provider = context.watch<ProposalProvider>();
    final isLoading = provider.isLoading;
    final proposal = provider.trackedProposal;
    final errorMessage = provider.errorMessage;
    final recent = provider.recentProposals;

    return Scaffold(
      appBar: AppBar(
        title: const Text('Lacak Penawaran Anda', style: TextStyle(fontWeight: FontWeight.bold, color: Colors.white)),
        backgroundColor: const Color(0xFF00236f),
        elevation: 0,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Instructions
            const Text(
              'Masukkan kode keamanan unik penawaran Anda untuk melihat perkembangan proses secara realtime.',
              style: TextStyle(fontSize: 14, color: Colors.black87),
            ),
            const SizedBox(height: 16),

            // Search Bar
            Row(
              children: [
                Expanded(
                  child: TextField(
                    controller: _codeController,
                    textCapitalization: TextCapitalization.characters,
                    decoration: InputDecoration(
                      hintText: 'Contoh: WD-202607-001',
                      prefixIcon: const Icon(Icons.key, color: Colors.grey),
                      filled: true,
                      fillColor: Colors.white,
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(10),
                        borderSide: BorderSide(color: Colors.grey.shade400),
                      ),
                      contentPadding: const EdgeInsets.symmetric(horizontal: 16),
                    ),
                  ),
                ),
                const SizedBox(width: 8),
                SizedBox(
                  height: 50,
                  child: ElevatedButton(
                    onPressed: isLoading ? null : () => _searchProposal(_codeController.text),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFF0058be),
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                    ),
                    child: const Icon(Icons.search, color: Colors.white),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 20),

            // Display loading placeholder via Skeletonizer, actual data, or error message
            if (isLoading)
              Skeletonizer(
                enabled: true,
                child: _buildDetailsCard(Proposal.dummy()),
              )
            else if (proposal != null)
              _buildDetailsCard(proposal)
            else if (errorMessage != null)
              Container(
                width: double.infinity,
                padding: const EdgeInsets.all(16),
                decoration: BoxDecoration(
                  color: Colors.red.shade50,
                  borderRadius: BorderRadius.circular(10),
                  border: Border.all(color: Colors.red.shade200),
                ),
                child: Row(
                  children: [
                    Icon(Icons.error_outline, color: Colors.red.shade700),
                    const SizedBox(width: 10),
                    Expanded(
                      child: Text(
                        errorMessage,
                        style: TextStyle(color: Colors.red.shade900, fontWeight: FontWeight.bold),
                      ),
                    ),
                  ],
                ),
              ),

            const SizedBox(height: 25),

            // Recent searches list
            const Text(
              'PENCARIAN TERAKHIR',
              style: TextStyle(fontSize: 12, fontWeight: FontWeight.bold, color: Colors.grey, letterSpacing: 1),
            ),
            const SizedBox(height: 8),
            if (recent.isEmpty)
              const Padding(
                padding: EdgeInsets.symmetric(vertical: 8.0),
                child: Text('Belum ada riwayat pencarian terbaru.', style: TextStyle(fontSize: 12, fontStyle: FontStyle.italic, color: Colors.grey)),
              )
            else
              ListView.builder(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                itemCount: recent.length,
                itemBuilder: (ctx, idx) {
                  final item = recent[idx];
                  return Card(
                    margin: const EdgeInsets.symmetric(vertical: 4),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                    child: ListTile(
                      dense: true,
                      title: Text(item['code'] ?? '', style: const TextStyle(fontWeight: FontWeight.bold, color: Color(0xFF00236f))),
                      subtitle: Text('${item['clientName']} • ${item['date']}', style: const TextStyle(fontSize: 11)),
                      trailing: const Icon(Icons.arrow_forward_ios, size: 14, color: Colors.grey),
                      onTap: () {
                        _codeController.text = item['code'] ?? '';
                        _searchProposal(item['code'] ?? '');
                      },
                    ),
                  );
                },
              ),

            const SizedBox(height: 25),

            // Help section
            Container(
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: Colors.grey.shade100,
                borderRadius: BorderRadius.circular(10),
                border: Border.all(color: Colors.grey.shade300),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    children: const [
                      Icon(Icons.help_center, color: Color(0xFF00236f)),
                      SizedBox(width: 8),
                      Text('BUTUH BANTUAN?', style: TextStyle(fontWeight: FontWeight.bold, color: Color(0xFF00236f))),
                    ],
                  ),
                  const SizedBox(height: 8),
                  const Text(
                    'Jika Anda kehilangan kode keamanan penawaran Anda atau mengalami kendala pemuatan data, silakan hubungi desainer pendamping Anda atau hubungi layanan bantuan kami.',
                    style: TextStyle(fontSize: 12, color: Colors.black87),
                  ),
                  const SizedBox(height: 12),
                  SizedBox(
                    height: 35,
                    child: OutlinedButton(
                      onPressed: () {},
                      style: OutlinedButton.styleFrom(
                        side: const BorderSide(color: Color(0xFF0058be)),
                        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
                      ),
                      child: const Text('Live Support (WA)', style: TextStyle(fontSize: 11, color: Color(0xFF0058be))),
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildDetailsCard(Proposal p) {
    Color statusColor = Colors.orange;
    if (p.status == 'Reviewed') statusColor = Colors.blue;
    if (p.status == 'Approved') statusColor = Colors.green;
    if (p.status == 'Rejected') statusColor = Colors.red;

    return Card(
      elevation: 3,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      clipBehavior: Clip.antiAlias,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // Banner Status
          Container(
            height: 6,
            color: statusColor,
          ),
          Padding(
            padding: const EdgeInsets.all(16.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // Proposal Code and Status Badge
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        const Text('KODE PENAWARAN', style: TextStyle(fontSize: 10, color: Colors.grey, fontWeight: FontWeight.bold)),
                        Text(p.proposalCode, style: const TextStyle(fontSize: 18, fontWeight: FontWeight.bold, color: Color(0xFF00236f))),
                      ],
                    ),
                    Container(
                      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                      decoration: BoxDecoration(
                        color: statusColor,
                        borderRadius: BorderRadius.circular(20),
                      ),
                      child: Text(
                        p.status,
                        style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 12),
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 15),

                // Client name & Info
                _buildInfoRow('Nama Klien', p.clientName),
                const SizedBox(height: 10),
                _buildInfoRow('Hubungi Klien', '${p.email} • ${p.phoneCountryCode} ${p.phoneNumber}'),
                const SizedBox(height: 10),
                _buildInfoRow('Alamat Pengiriman', '${p.addressStreet}${p.addressStreet2 != null ? '\n${p.addressStreet2}' : ''}\n${p.addressCity}, ${p.addressProvince} ${p.addressPostal}'),
                const SizedBox(height: 15),

                // Project description
                Container(
                  padding: const EdgeInsets.all(12),
                  decoration: BoxDecoration(
                    color: Colors.grey.shade50,
                    borderRadius: BorderRadius.circular(8),
                    border: Border.all(color: Colors.grey.shade200),
                  ),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Text('Deskripsi Kebutuhan Proyek:', style: TextStyle(fontSize: 11, color: Colors.grey, fontWeight: FontWeight.bold)),
                      const SizedBox(height: 4),
                      Text(
                        p.projectDescription ?? 'Tidak ada deskripsi proyek.',
                        style: const TextStyle(fontStyle: FontStyle.italic, fontSize: 13, color: Colors.black87),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 20),

                // Lifecycle indicator
                const Divider(),
                const SizedBox(height: 10),
                const Center(
                  child: Text('STATUS PESANAN', style: TextStyle(fontSize: 11, fontWeight: FontWeight.bold, color: Colors.grey, letterSpacing: 1)),
                ),
                const SizedBox(height: 15),
                _buildLifecycleTimeline(p.status),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildInfoRow(String label, String value) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label.toUpperCase(), style: const TextStyle(fontSize: 10, color: Colors.grey, fontWeight: FontWeight.bold)),
        const SizedBox(height: 2),
        Text(value, style: const TextStyle(fontSize: 14, color: Colors.black87, fontWeight: FontWeight.w500)),
      ],
    );
  }

  Widget _buildLifecycleTimeline(String status) {
    int activeStep = 1;
    if (status == 'Reviewed') activeStep = 2;
    if (status == 'Approved' || status == 'Rejected') activeStep = 3;
    bool isApproved = status == 'Approved';

    return Row(
      children: [
        _buildStepCircle(1, 'Diajukan', activeStep >= 1, isCurrent: activeStep == 1),
        _buildLine(activeStep >= 2),
        _buildStepCircle(2, 'Ditinjau', activeStep >= 2, isCurrent: activeStep == 2),
        _buildLine(activeStep >= 3),
        _buildStepCircle(
          3, 
          status == 'Rejected' ? 'Ditolak' : 'Keputusan', 
          activeStep >= 3, 
          isCurrent: activeStep == 3,
          isError: status == 'Rejected'
        ),
        _buildLine(isApproved),
        _buildStepCircle(4, 'Eksekusi', isApproved, isCurrent: isApproved),
      ],
    );
  }

  Widget _buildStepCircle(int step, String label, bool isDone, {bool isCurrent = false, bool isError = false}) {
    Color bg = Colors.white;
    Color border = Colors.grey.shade400;

    if (isDone) {
      bg = const Color(0xFF00236f).withOpacity(0.1);
      border = const Color(0xFF00236f);
    }
    if (isCurrent) {
      bg = isError ? Colors.red : const Color(0xFF00236f);
      border = isError ? Colors.red : const Color(0xFF00236f);
    }

    return Expanded(
      child: Column(
        children: [
          Container(
            width: 32,
            height: 32,
            decoration: BoxDecoration(
              color: bg,
              shape: BoxShape.circle,
              border: Border.all(color: border, width: 2),
            ),
            child: Center(
              child: Text(
                step.toString(),
                style: TextStyle(
                  color: isCurrent ? Colors.white : (isDone ? const Color(0xFF00236f) : Colors.grey),
                  fontWeight: FontWeight.bold,
                  fontSize: 12,
                ),
              ),
            ),
          ),
          const SizedBox(height: 4),
          Text(
            label,
            textAlign: TextAlign.center,
            style: TextStyle(
              fontSize: 10,
              fontWeight: isCurrent ? FontWeight.bold : FontWeight.normal,
              color: isError ? Colors.red : (isDone ? const Color(0xFF00236f) : Colors.grey),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildLine(bool isDone) {
    return Container(
      width: 20,
      height: 2,
      margin: const EdgeInsets.only(bottom: 16),
      color: isDone ? const Color(0xFF00236f) : Colors.grey.shade300,
    );
  }
}
