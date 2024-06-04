<?php

namespace App\Console\Commands;

use App\Models\Difficulty;
use App\Models\Event;
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
                'name' => 'Company registration'
            ],
            [
                'id' => 2,
                'name' => 'Participant registration'
            ],
            [
                'id' => 3,
                'name' => 'Presentation request'
            ]
        ],
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
