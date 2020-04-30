<?php


namespace App\Model;

class Data
{

    /**
     * @return int[]
     */
    public function cities(): array
    {
        return [
            'Paris' => 2968815,
            'London' => 2643743,
            'Rio de Janeiro' => 3451189,
            'Santiago' => 3526709,
            'New York City' => 5128581,
            'Los-Angeles' => 5368361,
            'Tokyo' => 1850147,
            'Peking' => 2855016,
            'Bombay' => 2193111,
            'Tehran' => 112931,
            'Cairo' => 360630,
            'Nairobi' => 184742,
            'Pretoria' => 964137,
            'Abuja' => 2352778,
            'Rabat' => 2538474,
            'Reykjavik' => 6692263,
            'Anchorage' => 4282497,
            'Vancouver' => 5814616,
            'Sydney' => 2147714,
            'Auckland' => 2193732,
        ];
    }

    /**
     * @return array[]
     */
    public function period(): array
    {
        return [
            [
                'period' => 'Art Préhistorique',
                'date' => -5000,
            ],
            [
                'period' => 'Premières civilisations',
                'date' => 1000,
            ],
            [
                'period' => 'XIeme siècle',
                'date' => 1100,
            ],
            [
                'period' => 'XIIeme siècle',
                'date' => 1200,
            ],
            [
                'period' => 'XIIIeme siècle',
                'date' => 1300,
            ],
            [
                'period' => 'XIVeme siècle',
                'date' => 1400,
            ],
            [
                'period' => 'XVeme siècle',
                'date' => 1500,
            ],
            [
                'period' => 'XVIeme siècle',
                'date' => 1600,
            ],
            [
                'period' => 'XVIIeme siècle',
                'date' => 1700,
            ],
            [
                'period' => 'XVIIIeme siècle',
                'date' => 1800,
            ],
            [
                'period' => 'XIXeme siècle',
                'date' => 1900,
            ],
            [
                'period' => 'XXeme siècle',
                'date' => 2000,
            ],
            [
                'period' => 'XXIeme siècle',
                'date' => 2100,
            ],
        ];
    }
}
