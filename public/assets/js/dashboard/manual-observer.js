// Dapatkan elemen berdasarkan selector
var tableElements = document.querySelectorAll("table:not(#calendar table)");
var emailListElement = document.querySelector("#email-list-items");

// Opsi untuk blockUI dengan spinner berwarna primary dan overlay transparan keputih-putihan
var blockUIOptions = {
   message: '<div class="spinner-border text-primary"></div>',
   overlayClass: "bg-white bg-opacity-10"
};

// Inisialisasi BlockUI untuk elemen target
var tableBlockUIs = Array.from(document.querySelectorAll("table:not(#calendar table)"))
                         .map(element => new KTBlockUI(element, blockUIOptions));
var emailListBlockUI = new KTBlockUI(document.querySelector("#email-list-items"), blockUIOptions);

function blockUI() {
    tableBlockUIs.forEach(block => block.block());
   //  emailListBlockUI.block();
}

function unblockUI() {
    tableBlockUIs.forEach(block => block.release());
   //  emailListBlockUI.release();
}

document.addEventListener('click', function (event) {
   if (
      event.target.classList.contains('page-link') ||
      event.target.classList.contains('nav-link')
   ) {
      blockUI();
   }
   let parentDropdown = event.target.closest('ul.dropdown-menu');
   if (parentDropdown && event.target.tagName.toLowerCase() === 'button') {
      blockUI();
   }
   if (event.target.getAttribute('wire:click') === "$dispatch('refresh')") {
      blockUI();
   }
   if (event.target.getAttribute('wire:click') === '$dispatch("refresh")') {
      blockUI();
   }
});

function debounce(func, wait, immediate) {
   var timeout;
   return function () {
      var context = this,
         args = arguments;
      var later = function () {
         timeout = null;
         if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
   };
}

document.addEventListener('input', debounce(function (event) {
   let target = event.target;
   if (target.tagName.toLowerCase() === 'input' && target.getAttribute('type') === 'search') {
      blockUI();
   }
   if (target.tagName.toLowerCase() === 'input' && target.getAttribute('type') === 'hidden' && target.classList.contains('flatpickr-input')) {
      blockUI();
   }
}, 500));

document.addEventListener('change', function (event) {
   let parentDropdown = event.target.closest('ul.dropdown-menu');
   let parentModal = event.target.closest('.modal');
   if (event.target.tagName.toLowerCase() === 'select' && !parentDropdown && !parentModal) {
      blockUI();
   }
});

Livewire.hook('message.processed', (message, component) => {
   unblockUI();
});
