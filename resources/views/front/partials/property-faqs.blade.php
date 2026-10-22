@if($property->faqs->count())
@include('front.partials.faq-schema', ['faqItems' => $property->faqs])
@once
<style>
   .property-faq-section {
      padding-top: 8px;
   }

   .property-faq-accordion {
      display: grid;
      gap: 14px;
   }

   .property-faq-item {
      border: 1px solid rgba(192, 150, 101, 0.28);
      border-radius: 18px;
      overflow: hidden;
      background: linear-gradient(180deg, rgba(255, 248, 240, 0.98) 0%, rgba(255, 255, 255, 1) 100%);
      box-shadow: 0 14px 34px rgba(20, 16, 11, 0.07);
   }

   .property-faq-header {
      margin-bottom: 0;
   }

   .property-faq-toggle {
      display: flex;
      width: 100%;
      gap: 18px;
      align-items: center;
      padding: 22px 26px;
      border: 0;
      border-radius: 0;
      background: transparent;
      color: #171411;
      box-shadow: none;
      font-family: Graphiklcg, sans-serif;
      font-size: 1.35rem;
      font-weight: 400;
      text-align: left;
      appearance: none;
      cursor: pointer;
   }

   .property-faq-toggle:not(.collapsed) {
      color: #171411;
      background: linear-gradient(90deg, rgba(192, 150, 101, 0.16) 0%, rgba(192, 150, 101, 0.03) 70%);
      box-shadow: none;
   }

   .property-faq-toggle:focus {
      box-shadow: none;
      border-color: transparent;
      outline: none;
   }

   .property-faq-index {
      flex: 0 0 54px;
      width: 54px;
      height: 54px;
      border-radius: 14px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: #c09665;
      color: #fff;
      font-size: 0.95rem;
      letter-spacing: 0.14em;
      font-weight: 500;
   }

   .property-faq-question {
      flex: 1 1 auto;
      line-height: 1.35;
      letter-spacing: -0.02em;
   }

   .property-faq-icon {
      flex: 0 0 42px;
      width: 42px;
      height: 42px;
      border: 1px solid rgba(192, 150, 101, 0.35);
      border-radius: 999px;
      position: relative;
      background: rgba(255, 255, 255, 0.85);
      transition: transform 0.2s ease, background-color 0.2s ease, border-color 0.2s ease;
   }

   .property-faq-icon::before,
   .property-faq-icon::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 14px;
      height: 2px;
      border-radius: 999px;
      background: #a88458;
      transform: translate(-50%, -50%);
      transition: transform 0.2s ease, opacity 0.2s ease;
   }

   .property-faq-icon::after {
      transform: translate(-50%, -50%) rotate(90deg);
   }

   .property-faq-toggle:not(.collapsed) .property-faq-icon {
      background: #c09665;
      border-color: #c09665;
      transform: rotate(180deg);
   }

   .property-faq-toggle:not(.collapsed) .property-faq-icon::before,
   .property-faq-toggle:not(.collapsed) .property-faq-icon::after {
      background: #fff;
   }

   .property-faq-toggle:not(.collapsed) .property-faq-icon::after {
      opacity: 0;
   }

   .property-faq-answer {
      padding: 0 26px 24px 98px;
      color: #4f4740;
      font-size: 1rem;
      line-height: 1.8;
   }

   .property-faq-answer > :last-child {
      margin-bottom: 0;
   }

   .property-faq-answer p,
   .property-faq-answer li {
      color: #4f4740;
   }

   @media (max-width: 767px) {
      .property-faq-toggle {
         padding: 18px;
         gap: 14px;
         font-size: 1.08rem;
      }

      .property-faq-index {
         flex-basis: 42px;
         width: 42px;
         height: 42px;
         border-radius: 12px;
         font-size: 0.8rem;
      }

      .property-faq-icon {
         flex-basis: 36px;
         width: 36px;
         height: 36px;
      }

      .property-faq-answer {
         padding: 0 18px 20px 18px;
         font-size: 0.95rem;
      }
   }
</style>
@endonce
<div class="overview mt-4 property-faq-section">
   <h3 class="property_detail-features_heading">FAQs</h3>
   <div class="accordion property-faq-accordion" id="propertyFaqAccordion{{ $property->id }}">
      @foreach($property->faqs as $faq)
      <div class="accordion-item property-faq-item">
         <h2 class="accordion-header property-faq-header" id="faqHeading{{ $property->id }}{{ $loop->index }}">
            <button class="property-faq-toggle {{ $loop->first ? '' : 'collapsed' }}" type="button" data-toggle="collapse" data-target="#faqCollapse{{ $property->id }}{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="faqCollapse{{ $property->id }}{{ $loop->index }}">
               <span class="property-faq-index">{{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</span>
               <span class="property-faq-question">{{ $faq->question }}</span>
               <span class="property-faq-icon" aria-hidden="true"></span>
            </button>
         </h2>
         <div id="faqCollapse{{ $property->id }}{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="faqHeading{{ $property->id }}{{ $loop->index }}" data-parent="#propertyFaqAccordion{{ $property->id }}">
            <div class="property-faq-answer">
               {!! $faq->answer !!}
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>
@endif