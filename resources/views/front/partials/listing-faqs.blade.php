@php
    $faqItems = collect($faqItems ?? [])->filter(function ($faqItem) {
        return !empty($faqItem['question'] ?? null) && !empty($faqItem['answer'] ?? null);
    })->values();
    $faqSectionId = $faqSectionId ?? 'listingFaqAccordion';
@endphp

@if($faqItems->isNotEmpty())
@include('front.partials.faq-schema', ['faqItems' => $faqItems])
@once
<style>
   .listing-faq-section {
      margin: 70px 0 40px;
      padding: 48px 0 28px;
      background: linear-gradient(180deg, #f7f1ea 0%, #ffffff 72%);
   }
   .listing-faq-section .listing-faq-heading {
      margin: 0 0 28px;
      color: #171411;
      font-family: Graphiklcg, sans-serif;
      font-size: clamp(1.8rem, 2.6vw, 2.4rem);
      font-weight: 400;
      letter-spacing: -0.02em;
   }
   .listing-faq-section .property-faq-accordion {
      display: grid;
      gap: 16px;
   }
   .listing-faq-section .property-faq-item {
      border: 1px solid rgba(192, 150, 101, 0.18);
      border-radius: 22px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 10px 28px rgba(20, 16, 11, 0.05);
      transition: box-shadow 0.2s ease, border-color 0.2s ease;
   }
   .listing-faq-section .property-faq-item:hover {
      border-color: rgba(192, 150, 101, 0.35);
      box-shadow: 0 14px 34px rgba(20, 16, 11, 0.08);
   }
   .listing-faq-section .property-faq-header {
      margin-bottom: 0;
   }
   .listing-faq-section .property-faq-toggle {
      display: flex;
      width: 100%;
      gap: 18px;
      align-items: center;
      padding: 20px 24px;
      border: 0;
      background: transparent;
      color: #3d2f24;
      font-family: Graphiklcg, sans-serif;
      font-size: 1.08rem;
      font-weight: 500;
      text-align: left;
      cursor: pointer;
   }
   .listing-faq-section .property-faq-toggle:focus {
      outline: none;
      box-shadow: none;
   }
   .listing-faq-section .property-faq-toggle:not(.collapsed) {
      background: rgba(192, 150, 101, 0.08);
   }
   .listing-faq-section .property-faq-index {
      flex: 0 0 44px;
      width: 44px;
      height: 44px;
      border-radius: 12px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: #c09665;
      color: #fff;
      font-size: 0.88rem;
      letter-spacing: 0.08em;
      font-weight: 600;
   }
   .listing-faq-section .property-faq-question {
      flex: 1 1 auto;
      line-height: 1.4;
   }
   .listing-faq-section .property-faq-icon {
      flex: 0 0 36px;
      width: 36px;
      height: 36px;
      border: 1px solid rgba(192, 150, 101, 0.35);
      border-radius: 999px;
      position: relative;
      background: #fff;
      transition: background-color 0.2s ease, border-color 0.2s ease;
   }
   .listing-faq-section .property-faq-icon::before,
   .listing-faq-section .property-faq-icon::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 12px;
      height: 2px;
      border-radius: 999px;
      background: #a88458;
      transform: translate(-50%, -50%);
      transition: opacity 0.2s ease;
   }
   .listing-faq-section .property-faq-icon::after {
      transform: translate(-50%, -50%) rotate(90deg);
   }
   .listing-faq-section .property-faq-toggle:not(.collapsed) .property-faq-icon {
      background: #c09665;
      border-color: #c09665;
   }
   .listing-faq-section .property-faq-toggle:not(.collapsed) .property-faq-icon::before,
   .listing-faq-section .property-faq-toggle:not(.collapsed) .property-faq-icon::after {
      background: #fff;
   }
   .listing-faq-section .property-faq-toggle:not(.collapsed) .property-faq-icon::after {
      opacity: 0;
   }
   .listing-faq-section .property-faq-answer {
      padding: 0 24px 22px 86px;
      color: #5c534c;
      font-size: 0.98rem;
      line-height: 1.75;
   }
   @media (max-width: 767px) {
      .listing-faq-section {
         margin: 48px 0 24px;
         padding: 32px 0 12px;
      }
      .listing-faq-section .listing-faq-heading {
         margin-bottom: 18px;
         font-size: 1.6rem;
      }
      .listing-faq-section .property-faq-toggle {
         padding: 16px 16px;
         gap: 12px;
         font-size: 0.98rem;
      }
      .listing-faq-section .property-faq-index {
         flex-basis: 38px;
         width: 38px;
         height: 38px;
         border-radius: 10px;
         font-size: 0.78rem;
      }
      .listing-faq-section .property-faq-icon {
         flex-basis: 32px;
         width: 32px;
         height: 32px;
      }
      .listing-faq-section .property-faq-answer {
         padding: 0 16px 18px 16px;
         font-size: 0.92rem;
      }
   }
</style>
@endonce
<section class="listing-faq-section">
   <div class="container">
      <h3 class="listing-faq-heading">FAQs</h3>
      <div class="accordion property-faq-accordion" id="{{ $faqSectionId }}">
         @foreach($faqItems as $faqItem)
         <div class="accordion-item property-faq-item">
            <h2 class="accordion-header property-faq-header" id="{{ $faqSectionId }}Heading{{ $loop->index }}">
               <button class="property-faq-toggle {{ $loop->first ? '' : 'collapsed' }}" type="button" data-toggle="collapse" data-target="#{{ $faqSectionId }}Collapse{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $faqSectionId }}Collapse{{ $loop->index }}">
                  <span class="property-faq-index">{{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</span>
                  <span class="property-faq-question">{{ $faqItem['question'] }}</span>
                  <span class="property-faq-icon" aria-hidden="true"></span>
               </button>
            </h2>
            <div id="{{ $faqSectionId }}Collapse{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="{{ $faqSectionId }}Heading{{ $loop->index }}" data-parent="#{{ $faqSectionId }}">
               <div class="property-faq-answer">{!! nl2br(e($faqItem['answer'])) !!}</div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>
@endif
