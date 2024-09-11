<?php

namespace App\Livewire\Forms;

use App\Models\FrequentQuestion;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FrequentQuestionForm extends Form
{
    public $faq;

    #[Validate('required|min:5|max:255|string')]
    public $question;

    #[Validate('required|min:5|max:800|string')]
    public $answer;

    /**
     * Sets the current values of the frequent question
     *
     * @param FrequentQuestion $faq
     * @return void
     */
    public function setFrequentQuestion(FrequentQuestion $faq)
    {
        $this->faq = $faq;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
    }

    /**
     * Updates the faq details with the new data
     * @return void
     */
    public function update()
    {
        $this->faq->update(
            $this->all()
        );
    }
}
