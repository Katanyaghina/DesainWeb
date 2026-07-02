class Proposal {
  final String proposalCode;
  final String date;
  final String clientName;
  final String email;
  final String phoneCountryCode;
  final String phoneNumber;
  final String addressStreet;
  final String? addressStreet2;
  final String addressCity;
  final String addressProvince;
  final String addressPostal;
  final String? projectDescription;
  final String status;

  Proposal({
    required this.proposalCode,
    required this.date,
    required this.clientName,
    required this.email,
    required this.phoneCountryCode,
    required this.phoneNumber,
    required this.addressStreet,
    this.addressStreet2,
    required this.addressCity,
    required this.addressProvince,
    required this.addressPostal,
    this.projectDescription,
    required this.status,
  });

  factory Proposal.fromJson(Map<String, dynamic> json) {
    return Proposal(
      proposalCode: json['proposal_code'] ?? '',
      date: json['created_at'] != null ? json['created_at'].toString().split('T')[0] : '',
      clientName: json['client_name'] ?? '',
      email: json['email'] ?? '',
      phoneCountryCode: json['phone_country_code'] ?? '',
      phoneNumber: json['phone_number'] ?? '',
      addressStreet: json['address_street'] ?? '',
      addressStreet2: json['address_street2'],
      addressCity: json['address_city'] ?? '',
      addressProvince: json['address_province'] ?? '',
      addressPostal: json['address_postal'] ?? '',
      projectDescription: json['project_description'],
      status: json['status'] ?? 'Pending',
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'proposal_code': proposalCode,
      'client_name': clientName,
      'email': email,
      'phone_country_code': phoneCountryCode,
      'phone_number': phoneNumber,
      'address_street': addressStreet,
      'address_street2': addressStreet2,
      'address_city': addressCity,
      'address_province': addressProvince,
      'address_postal': addressPostal,
      'project_description': projectDescription,
      'status': status,
    };
  }

  // Helper factory to generate a dummy proposal for Skeletonizer display
  factory Proposal.dummy() {
    return Proposal(
      proposalCode: 'WD-202607-999',
      date: '2026-07-02',
      clientName: 'PT. Nama Klien Dummy Contoh Panjang Sekali',
      email: 'klien.dummy@domaincontoh.com',
      phoneCountryCode: '+62',
      phoneNumber: '81234567890',
      addressStreet: 'Jalan Raya Sudirman Utama Kavling 21 Lantai 8',
      addressStreet2: 'Gedung Pencakar Langit Blok C',
      addressCity: 'Jakarta Selatan',
      addressProvince: 'DKI Jakarta',
      addressPostal: '12340',
      projectDescription: 'Kebutuhan pembuatan website e-commerce modern dengan payment gateway terintegrasi.',
      status: 'Pending',
    );
  }
}
