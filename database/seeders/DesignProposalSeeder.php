<?php

namespace Database\Seeders;

use App\Models\DesignProposal;
use Illuminate\Database\Seeder;

class DesignProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DesignProposal::create([
            'proposal_code' => 'WD-202607-001',
            'client_name' => 'PT. Maju Jaya Kreatif',
            'email' => 'ahmad@domain.com',
            'phone_country_code' => '+62',
            'phone_number' => '8123456789',
            'address_street' => 'Jalan Jend Sudirman Kav 21',
            'address_street2' => 'Gedung Antariksa Lt 5',
            'address_city' => 'Jakarta Selatan',
            'address_province' => 'DKI Jakarta',
            'address_postal' => '12340',
            'project_description' => 'Website e-commerce premium dengan integrasi pembayaran lokal.',
            'status' => 'Pending'
        ]);

        DesignProposal::create([
            'proposal_code' => 'WD-202606-012',
            'client_name' => 'CV. Bersinar Terang',
            'email' => 'info@bersinar.com',
            'phone_country_code' => '+62',
            'phone_number' => '8187654321',
            'address_street' => 'Jalan Diponegoro No. 45',
            'address_street2' => '',
            'address_city' => 'Surabaya',
            'address_province' => 'Jawa Timur',
            'address_postal' => '60231',
            'project_description' => 'Company profile interaktif dengan desain minimalis elegan dan CMS.',
            'status' => 'Reviewed'
        ]);

        DesignProposal::create([
            'proposal_code' => 'WD-202606-003',
            'client_name' => 'Singapore Tech Ventures',
            'email' => 'contact@sgventures.sg',
            'phone_country_code' => '+65',
            'phone_number' => '91234567',
            'address_street' => '12 Marina Boulevard',
            'address_street2' => '#22-04 Tower 3',
            'address_city' => 'Marina Bay',
            'address_province' => 'Singapore',
            'address_postal' => '018982',
            'project_description' => 'Landing page SaaS modern, responsif, dan teroptimasi SEO.',
            'status' => 'Approved'
        ]);
    }
}
