<?php

namespace AIGenerate\Models\Stock\Enums;

enum ReviewTypes: string
{
    case Amazing = 'amazing';

    case Good = 'good';
    case WeirdFace = 'weird_face';
    case Twisted = 'twisted';
    case DifferentPicture = 'different_picture';
    case NotWorking = 'not_working';
    case Nsfw = 'nsfw';
    case Feedback = 'feedback';

    /**
     * @return string
     */
    public function getName(): string
    {
        return match ($this) {
            self::Amazing => 'Amazing',
            self::Good => 'Good',
            self::WeirdFace => 'Weird Face',
            self::Twisted => 'Twisted',
            self::DifferentPicture => 'Different from the picture',
            self::NotWorking => 'Not working',
            self::Nsfw => 'NSFW',
            self::Feedback => 'Send Feedback',
        };
    }

}
