<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;

class LeadsTemplateExport implements FromArray, WithHeadings, WithTitle
{
    use Exportable;

    /**
     * Return the data array including one sample row
     *
     * @return array
     */
    public function array(): array
    {
        return [
            [
                'first_name'   => 'John',
                'last_name'    => 'Doe',
                'email'        => 'john.doe@example.com',
                'phone'        => '+1234567890',
                'source'       => 'Website',
                'stage'        => 'New',
                'assigned_to'  => 'Admin',
                'job_title'    => 'Manager',
                'industry'     => 'IT',
                'company'      => 'Example Corp',
                'website'      => 'https://example.com',
                'linkedin'     => 'https://linkedin.com/in/johndoe',
                'instagram'    => 'https://instagram.com/johndoe',
                'facebook'     => 'https://facebook.com/johndoe',
                'pinterest'    => '',
                'city'         => 'New York',
                'state'        => 'NY',
                'zip'          => '10001',
                'country'      => 'USA',
                'description'  => 'Sample lead description',
            ],
        ];
    }

    /**
     * Define the headings
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'first_name',
            'last_name',
            'email',
            'phone',
            'source',
            'stage',
            'assigned_to',
            'job_title',
            'industry',
            'company',
            'website',
            'linkedin',
            'instagram',
            'facebook',
            'pinterest',
            'city',
            'state',
            'zip',
            'country',
            'description',
        ];
    }

    /**
     * Optional: sheet title
     *
     * @return string
     */
    public function title(): string
    {
        return 'Leads Template';
    }
}
