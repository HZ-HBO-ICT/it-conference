<?php

namespace App\Console\Commands;

use App\Models\Difficulty;
use App\Models\Event;
use App\Models\FrequentQuestion;
use App\Models\Sponsorship;
use Exception;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpsertMasterData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:upsert-master-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upserts the master data.';

    /**
     * The models we want to upsert configuration data for
     *
     * @var array
     */
    private array $master_data = [
        Sponsorship::class => [
            ['id' => 1, 'name' => 'gold', 'max_sponsors' => '1'],
            ['id' => 2, 'name' => 'silver', 'max_sponsors' => '2'],
            ['id' => 3, 'name' => 'bronze', 'max_sponsors' => '5']
        ],
        Difficulty::class => [
            [
                'id' => 1,
                'level' => 'beginner',
                'description' => 'For those new to the subject; Provides a solid introduction'
            ],
            [
                'id' => 2,
                'level' => 'intermediate',
                'description' => 'Ready to delve deeper? Suitable for those with some prior knowledge'
            ],
            [
                'id' => 3,
                'level' => 'expert',
                'description' => 'Challenge yourself with these advanced presentations'
            ]
        ],
        Event::class => [
            [
                'id' => 1,
                'name' => 'Company registration',
                'description' => 'When the start date of this event arrives, companies will be able to register for the conference.
                  Once the end date arrives, the registration is closed.'
            ],
            [
                'id' => 2,
                'name' => 'Participant registration',
                'description' => 'This event is similar to company registration, but for participants.'
            ],
            [
                'id' => 3,
                'name' => 'Presentation request',
                'description' => 'When the start date of this event arrives, participants and companies will be able to request presentations.
                    Once the end date arrives, this functionality is closed.'
            ]
        ],
        FrequentQuestion::class => [
            [
                'id' => 1,
                'question' => 'What is the “We are in IT together Conference”?',
                'answer' => "The \"We are in IT together Conference\" is an inclusive platform where students,
                teachers, and IT company representatives collaborate through workshops, presentations, and booths.
                This event promotes knowledge exchange, enabling students to explore the dynamic IT industry and
                providing companies opportunities to connect with potential employees, offer internships, and engage
                with the university's educational approach. If you want to know more,
                check out our [YouTube channel](https://www.youtube.com/@WeareInITTogether) and last year's
                [impression video](https://www.youtube.com/watch?v=k-Psaz0hdQI) about the Conference.",
            ],
            [
                'id' => 2,
                'question' => 'When and where does the “We are in IT together Conference” take place?',
                'answer' => 'The conference will take place on November 17th at our location in Het Groenewoud
                Middelburg. Visit [hz.nl](https://www.hz.nl) for information about parking.'
            ],
            [
                'id' => 3,
                'question' => 'Can I follow the conference online?',
                'answer' => 'Unfortunately, we will not be able to provide online attendance or record sessions.',
            ],
            [
                'id' => 4,
                'question' => 'Can I join the conference as a participant?',
                'answer' => 'You can join the conference if you are an IT student, an Alumni HZ-ICT student, a company
                with a dedicated IT department or a member of our partnering company representatives.
                You can register using this website as soon as registrations have opened.',
            ],
            [
                'id' => 5,
                'question' => 'Can I be a partner with the \'We are in IT together Conference\'?',
                'answer' => 'If you work in the field of ICT, we would very much appreciate you wanting to join us and
                have our students get acquainted with your IT company. You can apply through the form to join
                the program.'
            ]
        ]
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle(): void
    {
        foreach ($this->master_data as $model => $data) {
            $this->info('Upserting ' . $model);
            // check that class exists
            if (!class_exists($model)) {
                throw new Exception('Configuration seed failed. Model does not exist.');
            }

            /**
             * seed each record
             */
            foreach ($data as $row) {
                $record = $this->getRecord($model, $row['id']);
                foreach ($row as $key => $value) {
                    $this->upsertRecord($record, $row);
                }
            }
        }
    }

    /**
     * _fetchRecord - fetches a record if it exists, otherwise instantiates a new model
     *
     * @param string $model - the model
     * @param integer $id - the model ID
     *
     * @return object - model instantiation
     */
    private function getRecord(string $model, int $id): object
    {
        if ($this->isSoftDeletable($model)) {
            $record = $model::withTrashed()->find($id);
        } else {
            $record = $model::find($id);
        }
        return $record ? $record : new $model;
    }

    /**
     * _upsertRecord - upsert a database record
     *
     * @param object $record - the record
     * @param array $row - the row of update data
     *
     * @return void
     */
    private function upsertRecord(object $record, array $row): void
    {
        foreach ($row as $key => $value) {
            if ($key === 'deleted_at' && $this->isSoftDeletable($record)) {
                if ($record->trashed() && !$value) {
                    $record->restore();
                } elseif (!$record->trashed() && $value) {
                    $record->delete();
                }
            } else {
                $record->$key = $value;
            }
        }
        $record->save();
    }

    /**
     * _isSoftDeletable - Determines if a model is soft-deletable
     *
     * @param string $model - the model in question
     *
     * @return boolean
     */
    private function isSoftDeletable(string $model): bool
    {
        $uses = array_merge(class_uses($model), class_uses(get_parent_class($model)));
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', $uses);
    }
}
