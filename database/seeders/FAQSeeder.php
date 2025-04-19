<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FrequentQuestion;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            // Registration & Tickets
            [
                'question' => 'How do I register for the conference?',
                'answer' => 'You can register for the conference through our online registration system. Click the "Register Now" button on the homepage and follow the steps. You\'ll need to provide your basic information and select your ticket type.',
                'category' => 'registration'
            ],
            [
                'question' => 'What is included?',
                'answer' => 'Your conference ticket includes:
- Access to all keynote sessions and presentations
- Entry to workshops and interactive sessions
- Conference materials and resources
- Lunch and refreshments during the conference
- Networking opportunities with industry professionals
- Access to the conference app',
                'category' => 'registration'
            ],
            [
                'question' => 'Is it paid? Do I get a refund if I can\'t attend?',
                'answer' => 'Yes, the conference is a paid event. Our refund policy allows for:
- Full refund up to 30 days before the event
- 50% refund between 30-14 days before the event
- No refund within 14 days of the event
However, you can transfer your ticket to another person at any time before the conference.',
                'category' => 'registration'
            ],

            // Programme & Content
            [
                'question' => 'How are speakers selected for the conference?',
                'answer' => 'Speakers are selected through a careful review process that considers:
- Expertise in their field
- Relevance of their topic to current IT trends
- Speaking experience and presentation skills
- Diversity of perspectives and backgrounds
We also welcome speaker proposals from our community.',
                'category' => 'programme'
            ],
            [
                'question' => 'Will presentations be recorded?',
                'answer' => 'Yes, all presentations will be recorded and made available to attendees after the conference. Attendees will receive access to:
- Video recordings of all sessions
- Presentation slides (where permitted by speakers)
- Additional resources shared during sessions',
                'category' => 'programme'
            ],
            [
                'question' => 'Can I suggest a topic or speaker for the conference?',
                'answer' => 'Yes! We welcome suggestions from our community. You can:
- Submit your ideas through our online form
- Email your suggestions to our program committee
- Propose yourself as a speaker
We review all suggestions and will contact you if we need more information.',
                'category' => 'programme'
            ],
        ];

        foreach ($faqs as $faq) {
            FrequentQuestion::create($faq);
        }
    }
}
