<?php

namespace Fcp\AnimalBreedsSearch\Console\Commands;

use Fcp\AnimalBreedsSearch\Facades\AnimalBreedsSearch;
use Illuminate\Console\Command;

/**
 * Class GetByAnimalTypeAndNameCommand
 * @package Fcp\AnimalBreedsSearch\Console\Commands
 */
class GetByAnimalTypeAndNameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animal-breeds:get {animal_type} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $animal_type = $this->argument('animal_type');
        $name = $this->argument('name');
        $breeds = AnimalBreedsSearch::getByAnimalTypeAndName($animal_type, $name);
        if (count($breeds)) {
            // Let's json_encode the properties of results to build a table
            $breeds = $this->flattenJsonEncodeArrayProperties($breeds);
            $this->table(array_keys(reset($breeds)), $breeds);
        } else {
            $this->line("No results found");
        }
    }

    /**
     * @param $breeds
     * @return array
     */
    public function flattenJsonEncodeArrayProperties($breeds): array
    {
        foreach ($breeds as &$breed) {
            foreach ($breed as &$property) {
                if (is_array($property)) {
                    $property = json_encode($property);
                }
            }
        }
        return $breeds;
    }
}
