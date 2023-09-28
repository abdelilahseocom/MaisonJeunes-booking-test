<?php

namespace Database\Seeders;
use App\City;
use App\Province;
use App\Region;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = collect([
            [
                "name" => "Dakhla-Oued Ed-Dahab",
                "provinces" => collect([
                    [
                        "name" => "Province d'Oued Ed-Dahab",
                        "cities" => collect([
                            ["name" => "Dakhla"],
                            ["name" => "Oued Ed-Dahab"],
                        ])
                    ],
                    [
                        "name" => "Province d'Aousserd",
                        "cities" => collect([
                            ["name" => "Aousserd"],
                        ])
                    ],
                ])

            ],
            [
                "name" => "Laâyoune-Sakia El Hamra",
                "provinces" => collect([
                    [
                        "name" => "Province de Laâyoune",
                        "cities" => collect([
                            ["name" => "Laâyoune"],
                        ])
                    ],
                    [
                        "name" => "Province de Boujdour",
                        "cities" => collect([
                            ["name" => "Boujdour"],
                        ])
                    ],
                    [
                        "name" => "Province de Tarfaya",
                        "cities" => collect([
                            ["name" => "Tarfaya"],
                        ])
                    ],
                ])

            ],
            [
                "name" => "Guelmim-Oued Noun",
                "provinces" => collect([
                    [
                        "name" => "Province de Guelmim",
                        "cities" => collect([
                            ["name" => "Guelmim"],
                        ])
                    ],
                    [
                        "name" => "Province d'Assa-Zag",
                        "cities" => collect([
                            ["name" => "Zag"],
                            ["name" => "Assa"],
                        ])
                    ],
                    [
                        "name" => "Province de Tan-Tan",
                        "cities" => collect([
                            ["name" => "Tan-Tan"],
                        ])
                    ],
                ])

            ],
            [
                "name" => "Souss-Massa",
                "provinces" => collect([
                    [
                        "name" => "Province d'Agadir Ida Ou Tanane",
                        "cities" => collect([
                            ["name" => "Agadir"],
                        ])
                    ],
                    [
                        "name" => "Province d'Inezgane Ait Melloul",
                        "cities" => collect([
                            ["name" => "Inezgane"],
                            ["name" => "Ait Melloul"],
                        ])
                    ],
                    [
                        "name" => "Province de Taroudant",
                        "cities" => collect([
                            ["name" => "Taroudant"],
                        ])
                    ],
                    [
                        "name" => "Province de Chtouka-Ait Baha",
                        "cities" => collect([
                            ["name" => "Tiznit"],
                            ["name" => "Ait Baha"],
                        ])
                    ],
                    [
                        "name" => "Province de Tiznit : ",
                        "cities" => collect([
                            ["name" => "Tiznit"],
                        ])
                    ],
                ])

            ],
            [
                "name" => "Drâa-Tafilalet",
                "provinces" => collect([
                    [
                        "name" => "Province d'Errachidia",
                        "cities" => collect([
                            ["name" => "Errachidia"],
                        ])
                    ],
                    [
                        "name" => "Province d'Ouarzazate",
                        "cities" => collect([
                            ["name" => "Ouarzazate"],
                        ])
                    ],
                    [
                        "name" => "Province de Zagora",
                        "cities" => collect([
                            ["name" => "Zagora"],
                        ])
                    ],
                    [
                        "name" => "Province de Midelt",
                        "cities" => collect([
                            ["name" => "Midelt"],
                        ])
                    ],
                    [
                        "name" => "Province de Tinghir",
                        "cities" => collect([
                            ["name" => "Tinghir"],
                        ])
                    ],
                ])

            ],
            [
                "name" => "Marrakech-Safi",
                "provinces" => collect([
                    [
                        "name" => "Province de Marrakech",
                        "cities" => collect([
                            ["name" => "Marrakech"],
                        ])
                    ],
                    [
                        "name" => "Province d'Essaouira",
                        "cities" => collect([
                            ["name" => "Essaouira"],
                        ])
                    ],
                    [
                        "name" => "Province de Safi",
                        "cities" => collect([
                            ["name" => "Safi"],
                        ])
                    ],
                    [
                        "name" => "Province d'Al Haouz",
                        "cities" => collect([
                            ["name" => "Asni"],
                            ["name" => "Imlil"],
                        ])
                    ],
                    [
                        "name" => "Province de Kelaa Sraghna",
                        "cities" => collect([
                            ["name" => "Kelaa Sraghna"],
                        ])
                    ],
                    [
                        "name" => "Province de Chichaoua",
                        "cities" => collect([
                            ["name" => "Chichaoua"],
                        ])
                    ],
                ])

            ],
            [
                "name" => "Casablanca-Settat",
                "provinces" => collect([
                    [
                        "name" => "Province de Casablanca",
                        "cities" => collect([
                            ["name" => "Casablanca"],
                        ])
                    ],
                    [
                        "name" => "Province de Settat",
                        "cities" => collect([
                            ["name" => "Settat"],
                        ])
                    ],
                ])

            ],
            [
                "name" => "Béni Mellal-Khénifra",
                "provinces" => collect([
                    [
                        "name" => "Province de Béni Mellal",
                        "cities" => collect([
                            ["name" => "Béni Mellal"],
                            ["name" => "Kasba Tadla"],
                        ])
                    ],
                    [
                        "name" => "Province d'Azilal",
                        "cities" => collect([
                            ["name" => "Azilal"],
                            ["name" => "Béni Ayat"],
                        ])
                    ],
                    [
                        "name" => "Province de Khénifra",
                        "cities" => collect([
                            ["name" => "Khénifra"],
                        ])
                    ],
                    [
                        "name" => "Province de Khouribga",
                        "cities" => collect([
                            ["name" => "Khouribga"],
                        ])
                    ],
                    [
                        "name" => "Province de Fquih Ben Salah",
                        "cities" => collect([
                            ["name" => "Fquih Ben Salah"],
                        ])
                    ],
                ])

            ],
            [
                "name" => "Rabat-Salé-Kénitra",
                "provinces" => collect([
                    [
                        "name" => "Province de Rabat",
                        "cities" => collect([
                            ["name" => "Rabat"],
                            ["name" => "Salé"],
                        ])
                    ],
                    [
                        "name" => "Province de Skhirat-Témara",
                        "cities" => collect([
                            ["name" => "Skhirat"],
                            ["name" => "Témara"],
                        ])
                    ],
                    [
                        "name" => "Province de Kénitra",
                        "cities" => collect([
                            ["name" => "Kénitra"],
                        ])
                    ],
                ])

            ],
            [
                "name" => "Fès-Meknès",
                "provinces" => collect([
                    [
                        "name" => "Province de Fès",
                        "cities" => collect([
                            ["name" => "Fès (Fez)"],
                            ["name" => "Sefrou"],
                            ["name" => "Ifrane"],
                            ["name" => "Moulay Yaacoub"],
                        ])
                    ],
                    [
                        "name" => "Province de Meknès",
                        "cities" => collect([
                            ["name" => "Meknès"],
                            ["name" => "El Hajeb"],
                        ])
                    ],
                    [
                        "name" => "Province de Boulemane",
                        "cities" => collect([
                            ["name" => "Boulemane"],
                        ])
                    ],
                    [
                        "name" => "Province de Taounate",
                        "cities" => collect([
                            ["name" => "Taounate"],
                        ])
                    ],
                ])
            ],
            [
                "name" => "L'Oriental",
                "provinces" => collect([
                    [
                        "name" => "Province d'Oujda-Angad",
                        "cities" => collect([
                            ["name" => "Tanger (Tanger)"],
                            ["name" => "Jerada"],
                        ])

                    ],
                    [
                        "name" => "Province de Nador",
                        "cities" => collect([
                            ["name" => "Nador"],
                            ["name" => "Beni Ansar"],
                        ])

                    ],
                    [
                        "name" => "Province de Berkane",
                        "cities" => collect([
                            ["name" => "Berkane"],
                            ["name" => "Saïdia"],
                        ])

                    ],
                    [
                        "name" => "Province de Taourirt",
                        "cities" => collect([
                            ["name" => "Taourirt"],
                        ])

                    ],
                    [
                        "name" => "Province de Driouch",
                        "cities" => collect([
                            ["name" => "Driouch"],
                        ])

                    ],
                ])
            ],
            [
                "name" => "Tanger-Tétouan-Al Hoceïma",
                "provinces" => collect([
                    [
                        "name" => "Province de Tanger",
                        "cities" => collect([
                            ["name" => "Tanger (Tanger)"],
                            ["name" => "Asilah"],
                        ])
                    ],
                    [
                        "name" => "Province de Tétouan",
                        "cities" => collect([
                            ["name" => "Tétouan"],
                            ["name" => "Martil"],
                        ])
                    ],
                    [
                        "name" => "Province d'Al Hoceima",
                        "cities" => collect([
                            ["name" => "Al Hoceima"],
                            ["name" => "Nador"],
                        ])
                    ],
                ])
            ],
        ]);
        $regions->each(function ($itemRegion) {
            $regionData = [
                "name" => $itemRegion["name"],
            ];
            if ($region = Region::firstOrCreate($regionData)) {
                if (count($itemRegion["provinces"]) > 0) {
                    foreach ($itemRegion["provinces"] as $provinceItem) {
                        $provinceData = [
                            "name" => $provinceItem["name"],
                            "region_id" => $region->id,
                        ];
                        if ($province = Province::firstOrCreate($provinceData)) {
                            if (count($provinceItem["cities"]) > 0) {
                                foreach ($provinceItem["cities"] as $cityItem) {
                                    $cityData = [
                                        "name" => $cityItem["name"],
                                        "province_id" => $province->id,
                                    ];
                                    City::firstOrCreate($cityData);
                                }
                            }
                        }
                    }
                }
            }
        });
    }
}
