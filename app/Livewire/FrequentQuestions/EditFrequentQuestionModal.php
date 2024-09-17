<?php

namespace App\Livewire\FrequentQuestions;

use App\Livewire\Forms\FrequentQuestionForm;
use App\Models\FrequentQuestion;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditFrequentQuestionModal extends ModalComponent
{
    public FrequentQuestion $faq;
    public FrequentQuestionForm $form;

    /**
     * Initializes the component
     * @param FrequentQuestion $faq
     * @return void
     */
    public function mount(FrequentQuestion $faq)
    {
        $this->faq = $faq;
        $this->form->setFrequentQuestion($faq);
    }

    /**
     * Saves the updates made on the form
     */
    public function save()
    {
        $this->validate();

        $this->form->update();

        return redirect(route('moderator.faqs.show', $this->faq))
            ->with('status', 'FAQ successfully updated.');
    }

    /**
     * Sets the maximum width of the modal according to docs:
     * https://github.com/wire-elements/modal
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    /**
     * Renders the component
     * @return View
     */
    public function render()
    {
        return view('livewire.frequent-questions.edit-frequent-question-modal');
    }
}
