<?php

namespace App\Livewire\FrequentQuestions;

use App\Models\FrequentQuestion;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteFrequentQuestionModal extends ModalComponent
{
    public FrequentQuestion $faq;

    /**
     * Renders the component
     * @return View
     */
    public function render()
    {
        return view('livewire.frequent-questions.delete-frequent-question-modal');
    }
}
