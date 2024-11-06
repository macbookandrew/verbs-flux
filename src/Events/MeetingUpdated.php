<?php

declare(strict_types=1);

namespace ArtisanBuild\VerbsFlux\Events;

use ArtisanBuild\Adverbs\Traits\SimpleApply;
use ArtisanBuild\VerbsFlux\Attributes\EventForm;
use ArtisanBuild\VerbsFlux\Attributes\EventInput;
use ArtisanBuild\VerbsFlux\Enums\InputTypes;
use ArtisanBuild\VerbsFlux\States\MeetingState;
use Carbon\Carbon;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

#[EventForm()]
class MeetingUpdated extends Event
{
    use SimpleApply;

    #[StateId(MeetingState::class)]
    public $meeting_id;

    #[EventInput(
        type: InputTypes::Text,
        params: [],
        rules: ['required', 'string', 'max:255'],
    )]
    public string $title;

    #[EventInput(
        type: InputTypes::Textarea,
        rows: 'auto',
    )]
    public string $description;

    #[EventInput(
        type: InputTypes::DatetimeLocal,
    )]
    public Carbon $start;

    #[EventInput(
        type: InputTypes::Number,
        params: ['min' => 15, 'max' => 90],
        description: 'Meeting duration between 15 and 90 minutes',
        suffix: 'Minutes',
        rules: ['required', 'numeric', 'min:15', 'max:90'],
    )]
    public int $duration;

    #[EventInput(
        type: InputTypes::Text,
    )]
    public ?string $location = null;

    #[EventInput(
        type: InputTypes::Text,
    )]
    public ?string $url = null;

}