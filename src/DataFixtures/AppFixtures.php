<?php

namespace App\DataFixtures;

use App\Entity\Astrologer;
use App\Entity\AstrologerService;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    private const SERVICE_FIXTURE = [
        ['title' => 'Natal chart'],
        ['title' => 'Detailed horoscope'],
        ['title' => 'Compatibility report'],
        ['title' => 'Year horoscope'],
    ];

    private const ASTROLOGER_FIXTURE = [
        [
            'firstName' => 'Lucy',
            'lastName' => 'Lee',
            'email' => 'lucylee@hotmail.com',
            //TODO : photo need
            'photo' => 'lucy_lee_photo.jpg',
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'services' => [
                [
                    'serviceId' => 1,
                    'cost' => 10.0
                ],
                [
                    'serviceId' => 2,
                    'cost' => 15.0
                ],
                [
                    'serviceId' => 3,
                    'cost' => 20.0
                ],
                [
                    'serviceId' => 4,
                    'cost' => 25.0
                ],
            ]
        ],
        [
            'firstName' => 'Ken',
            'lastName' => 'Kaneky',
            'email' => 'Kanekyken@hotmail.com',
            //TODO : photo need
            'photo' => 'kaneky_ken_photo.jpg',
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'services' => [
                [
                    'serviceId' => 1,
                    'cost' => 10.0
                ],
                [
                    'serviceId' => 2,
                    'cost' => 15.0
                ],
                [
                    'serviceId' => 3,
                    'cost' => 20.0
                ],
                [
                    'serviceId' => 4,
                    'cost' => 25.0
                ],
            ]
        ],
        [
            'firstName' => 'Barbara',
            'lastName' => 'Streisand',
            'email' => 'streisand_astrologer@hotmail.com',
            //TODO : photo need
            'photo' => 'streisand.jpg',
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'services' => [
                [
                    'serviceId' => 1,
                    'cost' => 10.0
                ],
                [
                    'serviceId' => 2,
                    'cost' => 15.0
                ],
                [
                    'serviceId' => 3,
                    'cost' => 20.0
                ],
                [
                    'serviceId' => 4,
                    'cost' => 25.0
                ],
            ]
        ],
        [
            'firstName' => 'Kevin',
            'lastName' => 'Hart',
            'email' => 'thehart@hotmail.com',
            //TODO : photo need
            'photo' => 'hart_kevin.jpg',
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'services' => [
                [
                    'serviceId' => 1,
                    'cost' => 10.0
                ],
                [
                    'serviceId' => 2,
                    'cost' => 15.0
                ],
                [
                    'serviceId' => 3,
                    'cost' => 20.0
                ],
                [
                    'serviceId' => 4,
                    'cost' => 25.0
                ],
            ]
        ],
        [
            'firstName' => 'Susan',
            'lastName' => 'Janet',
            'email' => 'janet1981@hotmail.com',
            //TODO : photo need
            'photo' => 'susan_janet.jpg',
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'services' => [
                [
                    'serviceId' => 1,
                    'cost' => 10.0
                ],
                [
                    'serviceId' => 2,
                    'cost' => 15.0
                ],
                [
                    'serviceId' => 3,
                    'cost' => 20.0
                ],
                [
                    'serviceId' => 4,
                    'cost' => 25.0
                ],
            ]
        ],
        [
            'firstName' => 'Emma',
            'lastName' => 'Stone',
            'email' => 'emastonek@hotmail.com',
            //TODO : photo need
            'photo' => 'stone.jpg',
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'services' => [
                [
                    'serviceId' => 1,
                    'cost' => 10.0
                ],
                [
                    'serviceId' => 2,
                    'cost' => 15.0
                ],
                [
                    'serviceId' => 3,
                    'cost' => 20.0
                ],
                [
                    'serviceId' => 4,
                    'cost' => 25.0
                ],
            ]
        ],
    ];

    private const ASTROLOGER_SERVICE_DATA = [
        [
            'astrologerId' => 1,
            'serviceId' => 1,
            'cost' => 10.0
        ],
        [
            'astrologerId' => 1,
            'serviceId' => 2,
            'cost' => 15.0
        ],
        [
            'astrologerId' => 1,
            'serviceId' => 3,
            'cost' => 20.0
        ],
        [
            'astrologerId' => 1,
            'serviceId' => 4,
            'cost' => 25.0
        ],
        [
            'astrologerId' => 2,
            'serviceId' => 1,
            'cost' => 10.0
        ],
        [
            'astrologerId' => 2,
            'serviceId' => 2,
            'cost' => 15.0
        ],
        [
            'astrologerId' => 2,
            'serviceId' => 3,
            'cost' => 20.0
        ],
        [
            'astrologerId' => 2,
            'serviceId' => 4,
            'cost' => 25.0
        ],
        [
            'astrologerId' => 3,
            'serviceId' => 1,
            'cost' => 10.0
        ],
        [
            'astrologerId' => 3,
            'serviceId' => 2,
            'cost' => 15.0
        ],
        [
            'astrologerId' => 3,
            'serviceId' => 3,
            'cost' => 20.0
        ],
        [
            'astrologerId' => 3,
            'serviceId' => 4,
            'cost' => 25.0
        ],
        [
            'astrologerId' => 4,
            'serviceId' => 1,
            'cost' => 10.0
        ],
        [
            'astrologerId' => 4,
            'serviceId' => 2,
            'cost' => 15.0
        ],
        [
            'astrologerId' => 4,
            'serviceId' => 3,
            'cost' => 20.0
        ],
        [
            'astrologerId' => 4,
            'serviceId' => 4,
            'cost' => 25.0
        ],
        [
            'astrologerId' => 5,
            'serviceId' => 1,
            'cost' => 10.0
        ],
        [
            'astrologerId' => 5,
            'serviceId' => 2,
            'cost' => 15.0
        ],
        [
            'astrologerId' => 5,
            'serviceId' => 3,
            'cost' => 20.0
        ],
        [
            'astrologerId' => 5,
            'serviceId' => 4,
            'cost' => 25.0
        ],
        [
            'astrologerId' => 6,
            'serviceId' => 1,
            'cost' => 10.0
        ],
        [
            'astrologerId' => 6,
            'serviceId' => 2,
            'cost' => 15.0
        ],
        [
            'astrologerId' => 6,
            'serviceId' => 3,
            'cost' => 20.0
        ],
        [
            'astrologerId' => 6,
            'serviceId' => 4,
            'cost' => 25.0
        ],
    ];

    private array $services = [];

    private DenormalizerInterface $denormalizer;

    /**
     * AppFixtures constructor.
     * @param DenormalizerInterface $denormalizer
     */
    public function __construct(DenormalizerInterface $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

    /**
     * @param ObjectManager $manager
     * @throws ExceptionInterface
     */
    public function load(ObjectManager $manager) : void
    {
        $this->loadServices($manager);
        $this->loadAstrologers($manager);
//        $this->loadAstrologersService($manager);
    }

    /**
     * @param ObjectManager $manager
     * @throws ExceptionInterface
     */
    private function loadServices(ObjectManager $manager) : void
    {
        foreach (self::SERVICE_FIXTURE as $serviceData) {
            $service = $this->denormalizer->denormalize($serviceData, Service::class);
            $this->services[] = $service;
            $manager->persist($service);
        }

        $manager->flush();
        $this->services = array_combine([1, 2, 3, 4], $this->services);
    }

    /**
     * @param ObjectManager $manager
     * @throws ExceptionInterface
     */
    private function loadAstrologers(ObjectManager $manager) : void
    {
        foreach (self::ASTROLOGER_FIXTURE as $astrologerData) {
            /** @var Astrologer $astrologer */
            $astrologer = $this->denormalizer->denormalize($astrologerData, Astrologer::class);
            $astrologerServices = $astrologer->getServices();
            foreach ($astrologerServices as $astrologerService) {
                $astrologerService->setService($this->services[$astrologerService->getServiceId()]);
            }
            $manager->persist($astrologer);
        }

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @throws ExceptionInterface
     */
    private function loadAstrologersService(ObjectManager $manager) : void
    {
        foreach (self::ASTROLOGER_SERVICE_DATA as $astrologerServiceData) {
            $astrologerService = $this->denormalizer->denormalize($astrologerServiceData, AstrologerService::class);
            $manager->persist($astrologerService);
        }

        $manager->flush();
    }
}
