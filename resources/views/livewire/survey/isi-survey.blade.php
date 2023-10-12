<div>
   <div class="card border-0">
      <!--begin::Card body-->
      <div class="card-body">
         <div id="surveyContainer"></div>
      </div>
      <!--end::Card body-->
   </div>
</div>

@push('scripts')
   <script>
      $(document).ready(function() {
         initializeSurvey();
      });

      function initializeSurvey() {
         const surveyJson = {
            elements: [{
               name: "FirstName",
               title: "Enter your first name:",
               type: "text"
            }, {
               name: "LastName",
               title: "Enter your last name:",
               type: "text"
            }]
         };

         const survey = new Survey.Model(surveyJson);
         survey.focusFirstQuestionAutomatic = false;

         function alertResults(sender) {
            const results = JSON.stringify(sender.data);
            alert(results);
         }

         survey.onComplete.add(alertResults);

         $("#surveyContainer").Survey({
            model: survey
         });
      }
   </script>
@endpush
