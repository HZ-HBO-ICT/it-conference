@props([
    'id' => 'editor-'. str()->random(8),
    'height' => '400px',
    'label' => null,
    'name' => null,
    'value' => null,
    'noMargin' => false,
    'readonly' => false,
    'disabled' => false,
    'toolbar' => true
])

<div class="w-full">
    @if($label)
        <label class="block font-medium text-sm text-gray-200 mb-1">
            {{ $label }}
        </label>
    @endif
    <div x-data="{
	height: '{{ $height }}',
	tab: 'write',
	@if ($attributes->has('wire:model'))
	 content: @entangle($attributes->wire('model')),
	@else
	 content: {{ collect($value) }},
	@endif
	showConvertedMarkdown: false,
	convertedContent: '',
	convertedMarkdown() {
	 this.showConvertedMarkdown = true;
	 this.convertedContent = marked.parse(DOMPurify.sanitize(this.content));
	},
	replaceSelectedText(replacementText, newCharactersLength) {
		// 1. obtain the object reference for the textarea
		const textareaRef = this.$refs.input;
		// 2. obtain the index of the first selected character
		let start = textareaRef.selectionStart;
		// 3. obtain the index of the last selected character
		let finish = textareaRef.selectionEnd;
		// 4. obtain all the text content
		const allText = textareaRef.value;
		// 5. Bind 'allText' to the 'content' data object
		this.content = allText.substring(0, start) + replacementText + allText.substring(finish, allText.length);
		// 6. Put the cursor to the end of selected text
		this.$nextTick(() => this.setCursorPosition(this.$refs.input, finish + newCharactersLength));
	},
	setCursorPosition(el, pos) {
	 el.focus();
	 el.setSelectionRange(pos, pos);
	},
	toggleMenu(value) {
		let selectedString = document.getSelection();
		let linkText = selectedString.toString().startsWith('http') ? selectedString : 'Your link';
		switch (value) {
		    case 'h1':
			this.replaceSelectedText(`# ${selectedString}`, 2);
			break;
		    case 'h2':
			this.replaceSelectedText(`## ${selectedString}`, 3);
			break;
		    case 'h3':
			this.replaceSelectedText(`### ${selectedString}`, 4);
			break;
			case 'bold':
			this.replaceSelectedText(`**${selectedString}**`, 4);
			break;
			case 'italic':
			this.replaceSelectedText(`*${selectedString}*`, 2);
			break;
			case 'quote':
			this.replaceSelectedText(`> ${selectedString}`, 2);
			break;
			case 'link':
			this.replaceSelectedText(`[${selectedString}](${linkText})`, 4);
			break;
			case 'orderedList':
			this.replaceSelectedText(`1. ${selectedString}`, 3);
			break;
			case 'unorderedList':
			this.replaceSelectedText(`* ${selectedString}`, 2);
			break;
		}
	},
	}"
         class="relative" x-cloak wire:ignore>

        <div
            class="flex divide-x items-center bg-slate-900 border border-b-0 border-slate-950 block rounded-t-md text-gray-100 pr-4">
            <div class="px-2">
                <button type="button" class="py-1 px-1 inline-block font-semibold text-sm hover:cursor-pointer"
                        :class="{ 'text-waitt-yellow': tab === 'write' }"
                        x-on:click.prevent="tab = 'write'; showConvertedMarkdown = false">Write
                </button>
                <button type="button" class="py-1 px-1 inline-block font-semibold text-sm hover:cursor-pointer"
                        :class="{ 'text-waitt-yellow': tab === 'preview' && showConvertedMarkdown === true }"
                        x-on:click.prevent="tab = 'preview'; convertedMarkdown()">Preview
                </button>
            </div>
            <div class="px-2">
                @if ($toolbar)
                    <button x-tooltip="'bold'" type="button" class="py-1 px-1 inline-block group hover:cursor-pointer"
                            x-on:click.prevent="toggleMenu('h1')">
                        <svg class="h-4 w-4 text-gray-500 group-hover:text-waitt-yellow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.243 4.493v7.5m0 0v7.502m0-7.501h10.5m0-7.5v7.5m0 0v7.501m4.501-8.627 2.25-1.5v10.126m0 0h-2.25m2.25 0h2.25" />
                        </svg>
                    </button>
                    <button x-tooltip="'bold'" type="button" class="py-1 px-1 inline-block group hover:cursor-pointer"
                            x-on:click.prevent="toggleMenu('h2')">
                        <svg class="h-4 w-4 text-gray-500 group-hover:text-waitt-yellow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 19.5H16.5v-1.609a2.25 2.25 0 0 1 1.244-2.012l2.89-1.445c.651-.326 1.116-.955 1.116-1.683 0-.498-.04-.987-.118-1.463-.135-.825-.835-1.422-1.668-1.489a15.202 15.202 0 0 0-3.464.12M2.243 4.492v7.5m0 0v7.502m0-7.501h10.5m0-7.5v7.5m0 0v7.501" />
                        </svg>
                    </button>
                    <button x-tooltip="'bold'" type="button" class="py-1 px-1 inline-block group hover:cursor-pointer"
                            x-on:click.prevent="toggleMenu('h3')">
                        <svg class="h-4 w-4 text-gray-500 group-hover:text-waitt-yellow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.905 14.626a4.52 4.52 0 0 1 .738 3.603c-.154.695-.794 1.143-1.504 1.208a15.194 15.194 0 0 1-3.639-.104m4.405-4.707a4.52 4.52 0 0 0 .738-3.603c-.154-.696-.794-1.144-1.504-1.209a15.19 15.19 0 0 0-3.639.104m4.405 4.708H18M2.243 4.493v7.5m0 0v7.502m0-7.501h10.5m0-7.5v7.5m0 0v7.501" />
                        </svg>
                    </button>
                    <button x-tooltip="'bold'" type="button" class="py-1 px-1 inline-block group hover:cursor-pointer"
                            x-on:click.prevent="toggleMenu('bold')">
                        <svg class="h-4 w-4 text-gray-500 group-hover:text-waitt-yellow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linejoin="round" d="M6.75 3.744h-.753v8.25h7.125a4.125 4.125 0 0 0 0-8.25H6.75Zm0 0v.38m0 16.122h6.747a4.5 4.5 0 0 0 0-9.001h-7.5v9h.753Zm0 0v-.37m0-15.751h6a3.75 3.75 0 1 1 0 7.5h-6m0-7.5v7.5m0 0v8.25m0-8.25h6.375a4.125 4.125 0 0 1 0 8.25H6.75m.747-15.38h4.875a3.375 3.375 0 0 1 0 6.75H7.497v-6.75Zm0 7.5h5.25a3.75 3.75 0 0 1 0 7.5h-5.25v-7.5Z" />
                        </svg>
                    </button>
                    <button x-tooltip="'italic'" type="button" class="py-1 px-1 inline-block group hover:cursor-pointer"
                            x-on:click.prevent="toggleMenu('italic')">
                        <svg class="h-4 w-4 text-gray-500 group-hover:text-waitt-yellow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.248 20.246H9.05m0 0h3.696m-3.696 0 5.893-16.502m0 0h-3.697m3.697 0h3.803" />
                        </svg>
                    </button>
                    <button x-tooltip="'quote'" type="button" class="py-1 px-1 inline-block group hover:cursor-pointer"
                            x-on:click.prevent="toggleMenu('quote')">
                        <svg class="h-4 w-4 text-gray-500 group-hover:text-waitt-yellow" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.79999 21.4698H4.58002C2.75002 21.4698 1.25 19.9798 1.25 18.1398V12.3398C1.25 11.9298 1.59 11.5898 2 11.5898H7.79999C9.69999 11.5898 11.13 13.0198 11.13 14.9198V18.1398C11.12 20.0398 9.68999 21.4698 7.79999 21.4698ZM2.75 13.0998V18.1498C2.75 19.1598 3.57002 19.9798 4.58002 19.9798H7.79999C8.85999 19.9798 9.63 19.2098 9.63 18.1498V14.9298C9.63 13.8698 8.85999 13.0998 7.79999 13.0998H2.75Z"
                                fill="currentColor"/>
                            <path
                                d="M2 13.0998C1.59 13.0998 1.25 12.7598 1.25 12.3498C1.25 6.0998 2.52002 4.78984 6.15002 2.63984C6.51002 2.42984 6.96999 2.54985 7.17999 2.89985C7.38999 3.25985 7.26998 3.71982 6.91998 3.92982C3.67998 5.84981 2.75 6.6498 2.75 12.3498C2.75 12.7598 2.41 13.0998 2 13.0998Z"
                                fill="currentColor"/>
                            <path
                                d="M19.4211 21.4698H16.2011C14.3711 21.4698 12.8711 19.9798 12.8711 18.1398V12.3398C12.8711 11.9298 13.2111 11.5898 13.6211 11.5898H19.4211C21.3211 11.5898 22.7511 13.0198 22.7511 14.9198V18.1398C22.7511 20.0398 21.3211 21.4698 19.4211 21.4698ZM14.3811 13.0998V18.1498C14.3811 19.1598 15.2011 19.9798 16.2111 19.9798H19.4311C20.4911 19.9798 21.2611 19.2098 21.2611 18.1498V14.9298C21.2611 13.8698 20.4911 13.0998 19.4311 13.0998H14.3811Z"
                                fill="currentColor"/>
                            <path
                                d="M13.6289 13.0998C13.2189 13.0998 12.8789 12.7598 12.8789 12.3498C12.8789 6.0998 14.1489 4.78984 17.7789 2.63984C18.1389 2.42984 18.5989 2.54985 18.8089 2.89985C19.0189 3.25985 18.8989 3.71982 18.5489 3.92982C15.3089 5.84981 14.3789 6.6498 14.3789 12.3498C14.3789 12.7598 14.0389 13.0998 13.6289 13.0998Z"
                                fill="currentColor"/>
                        </svg>
                    </button>
                    <button x-tooltip="'link'" type="button" class="py-1 px-1 inline-block group  hover:cursor-pointer"
                            x-on:click.prevent="toggleMenu('link')">
                        <svg class="h-4 w-4 text-gray-500 group-hover:text-waitt-yellow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                        </svg>
                    </button>
                @endif
            </div>
            <div class="px-2">
                <button x-tooltip="'bold'" type="button" class="py-1 px-1 inline-block group  hover:cursor-pointer"
                        x-on:click.prevent="toggleMenu('unorderedList')">
                    <svg class="h-4 w-4 text-gray-500 group-hover:text-waitt-yellow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </button>
                <button x-tooltip="'bold'" type="button" class="py-1 px-1 inline-block group  hover:cursor-pointer"
                        x-on:click.prevent="toggleMenu('orderedList')">
                    <svg class="h-4 w-4 text-gray-500 group-hover:text-waitt-yellow"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.242 5.992h12m-12 6.003H20.24m-12 5.999h12M4.117 7.495v-3.75H2.99m1.125 3.75H2.99m1.125 0H5.24m-1.92 2.577a1.125 1.125 0 1 1 1.591 1.59l-1.83 1.83h2.16M2.99 15.745h1.125a1.125 1.125 0 0 1 0 2.25H3.74m0-.002h.375a1.125 1.125 0 0 1 0 2.25H2.99" />
                    </svg>
                </button>
            </div>
            <div class="relative" x-data="{ open: false }" x-on:click.away="open = false"
                 x-on:close.stop="open = false">
                <button x-tooltip="'Markdown Cheatsheet'" type="button"
                        class="rounded-lg py-2 px-2 inline-block group focus:ring-1 focus:ring-apricot-peach-200  hover:cursor-pointer"
                        x-on:click="open = ! open">
                    <svg class="h-5 w-5 transform rotate-180 text-gray-500 group-hover:text-waitt-yellow"
                         viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z"
                            fill="currentColor"/>
                        <path
                            d="M12 13.75C11.59 13.75 11.25 13.41 11.25 13V8C11.25 7.59 11.59 7.25 12 7.25C12.41 7.25 12.75 7.59 12.75 8V13C12.75 13.41 12.41 13.75 12 13.75Z"
                            fill="currentColor"/>
                        <path
                            d="M12 16.9999C11.87 16.9999 11.74 16.9699 11.62 16.9199C11.5 16.8699 11.39 16.7999 11.29 16.7099C11.2 16.6099 11.13 16.5099 11.08 16.3799C11.03 16.2599 11 16.1299 11 15.9999C11 15.8699 11.03 15.7399 11.08 15.6199C11.13 15.4999 11.2 15.3899 11.29 15.2899C11.39 15.1999 11.5 15.1299 11.62 15.0799C11.86 14.9799 12.14 14.9799 12.38 15.0799C12.5 15.1299 12.61 15.1999 12.71 15.2899C12.8 15.3899 12.87 15.4999 12.92 15.6199C12.97 15.7399 13 15.8699 13 15.9999C13 16.1299 12.97 16.2599 12.92 16.3799C12.87 16.5099 12.8 16.6099 12.71 16.7099C12.61 16.7999 12.5 16.8699 12.38 16.9199C12.26 16.9699 12.13 16.9999 12 16.9999Z"
                            fill="currentColor"/>
                    </svg>
                </button>
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute z-50 mt-2 w-80 rounded-md shadow-lg origin-top-right right-0 -mr-5"
                     style="display: none;"
                     x-on:click="open = false">
                    <div class="rounded-md ring-1 ring-black ring-opacity-5 p-4 bg-slate-900 border-slate-950 text-gray-100 text-sm">
                        <div
                            class="px-2 py-1 text-xs font-medium uppercase tracking-wider bg-slate-900 border border-slate-950 mb-2 text-center rounded-sm text-gray-600">
                            Markdown Notes<br><span class="text-xs">(currently supported)</span></div>
                        <div class="flex py-1">
                            <div class="shrink-0 text-gray-500 flex-1 text-right pr-5">Heading</div>
                            <div class="text-gray-800 flex-1 font-mono text-xs mt-1">## Heading H2</div>
                        </div>
                        <div class="flex py-1">
                            <div class="shrink-0 text-gray-500 flex-1 text-right pr-5">Bold</div>
                            <div class="text-gray-800 flex-1 font-mono text-xs mt-1">**bold text**</div>
                        </div>
                        <div class="flex py-1">
                            <div class="shrink-0 text-gray-500 flex-1 text-right pr-5">Italic</div>
                            <div class="text-gray-800 flex-1 font-mono text-xs mt-1">*italicized text*</div>
                        </div>
                        <div class="flex py-1">
                            <div class="shrink-0 text-gray-500 flex-1 text-right pr-5">Blockquote</div>
                            <div class="text-gray-800 flex-1 font-mono text-xs mt-1">> blockquote</div>
                        </div>
                        <div class="flex py-1">
                            <div class="shrink-0 text-gray-500 flex-1 text-right pr-5">Ordered List</div>
                            <div class="text-gray-800 flex-1 font-mono text-xs mt-1">
                                1. First <br>
                                2. Second
                            </div>
                        </div>
                        <div class="flex py-1">
                            <div class="shrink-0 text-gray-500 flex-1 text-right pr-5">Unordered List</div>
                            <div class="text-gray-800 flex-1 font-mono text-xs mt-1">
                                - First <br>
                                - Second
                            </div>
                        </div>
                        <div class="flex py-1">
                            <div class="shrink-0 text-gray-500 flex-1 text-right pr-5">Horizontal Rule</div>
                            <div class="text-gray-800 flex-1 font-mono text-xs mt-1">---</div>
                        </div>
                        <div class="flex py-1">
                            <div class="shrink-0 text-gray-500 flex-1 text-right pr-5">Link</div>
                            <div class="text-gray-800 flex-1 font-mono text-xs mt-1">[title](url)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <textarea spellcheck="true" x-show="! showConvertedMarkdown" id="{{ $id }}" x-ref="input" x-model="content"
                  name="{{ $name }}"
                  class="overflow-y-auto form-textarea bg-slate-900 relative transition duration-150 ease-in-out block w-full font-mono text-sm border border-slate-950 px-5 py-6 resize-none text-gray-100 rounded-b-md focus:outline-hidden focus:border-teal-500 focus:ring-1 focus:ring-teal-500"
                  :style="`height: ${height}; max-width: 100%`"></textarea>

        <div x-show="showConvertedMarkdown">
            <div x-html="convertedContent"
                 class="w-full text-left prose max-w-none prose-waitt-pink text-gray-100 leading-6 rounded-b-md shadow-xs border border-slate-950 p-5 bg-slate-900 overflow-y-auto"
                 :style="`height: ${height}; max-width: 100%`"></div>
        </div>
    </div>

    @error($name)
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
