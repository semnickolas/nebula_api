<?php


namespace App\Component;

use App\Entity\Astrologer;
use App\Entity\AstrologerService;
use Doctrine\Common\Collections\Collection;
use App\Enum\AstrologerIndexesEnum as Index;

/**
 * Class AstrologerDataFormatter
 * @package App\Component
 */
class AstrologerDataFormatter
{
    /**
     * @param Astrologer $astrologer
     * @return array
     */
    public function format(Astrologer $astrologer) : array
    {
        $result = $this->getMainData($astrologer);
        $this->appendServices($result, $astrologer->getServices());

        return $result;
    }

    /**
     * @param array $astrologers
     * @return array
     */
    public function formatAstrologers(array $astrologers) : array
    {
        $result = [];
        foreach ($astrologers as $astrologer) {
            $astrologerId = $astrologer->getId();
            $result[$astrologerId] = [
                Index::ID => $astrologerId,
                Index::PHOTO => $astrologer->getPhoto(),
                Index::FIRST_NAME => $astrologer->getFirstName(),
                Index::LAST_NAME => $astrologer->getLastName(),
            ];
            $this->appendServices($result[$astrologerId], $astrologer->getServices());
        }

        return $result;
    }

    /**
     * @param Astrologer $astrologer
     * @return array
     */
    private function getMainData(Astrologer $astrologer) : array
    {
        return [
            Index::ID => $astrologer->getId(),
            Index::FIRST_NAME => $astrologer->getFirstName(),
            Index::LAST_NAME => $astrologer->getLastName(),
            Index::EMAIL => $astrologer->getEmail(),
            Index::PHOTO => $astrologer->getPhoto(),
            Index::BIO => $astrologer->getBio(),
        ];
    }

    /**
     * @param array $result
     * @param Collection $services
     */
    private function appendServices(array &$result, Collection $services) : void
    {
        /** @var AstrologerService $service */
        foreach ($services as $service) {
            $result[Index::SERVICES][] = [
                Index::ID => $service->getId(),
                Index::SERVICE_NAME => $service->getService()->getTitle(),
                Index::COST => $service->getCost(),
            ];
        }
    }
}