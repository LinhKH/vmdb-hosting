// NAV TAB
function openTab(evt, tabName) {
  if(!evt.currentTarget.classList.contains('disabled')) {
    var i, tabcontent, tablinks, tab_btn, tabBtns;
    //hide all tab contents
    tabcontent = $(evt.target).parents(".tab").siblings(".tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    //remove active all tab links
    tablinks = $(evt.target).parents(".tab").find(".tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab
    document.getElementById(tabName).style.display = "block";
    // add an "active" class to the button that opened the tab
    if(!evt.currentTarget.classList.contains('active')) {
        tab_btn = evt.currentTarget.className.replace(" tablinks-mobile", "").replaceAll(" ", ".");
        tabBtns = $(evt.target).parents(".tab").find('.' + tab_btn);
        [].forEach.call(tabBtns, function (item) {
            item.className += " active";
        })
    }
  }
}

// MODAL
const modalTriggers = document.querySelectorAll('.modal-trigger');
const modalClose = document.querySelectorAll('.modal-content .close');
const body = document.querySelector('body');

function createOverlay(parent) {
  var div = document.createElement("div");
  div.setAttribute('class', 'modal-backdrop fade show');
  parent.appendChild(div);
}

function removeModal(modal) {
  modal.style.paddingRight = 0;
  modal.style.display = "none";   
  body.classList.remove('modal-open');
  body.style.paddingRight = 0;
  if(document.querySelector('.modal-backdrop')) {
    document.querySelector('.modal-backdrop').remove();
  }
}

Array.from(modalTriggers).forEach(trigger => {
  trigger.addEventListener('click', function(e) {
    e.preventDefault();
    const modalId = trigger.dataset.modal;
    const modal = document.querySelector('#' + modalId);
    modal.classList.add('show');
    modal.style.paddingRight = "17px";
    modal.style.display = "block";
    body.classList.add('modal-open');
    if(body.scrollWidth > body.clientWidth) {
      body.style.paddingRight = '17px';
    };
    createOverlay(body);
  });
});

Array.from(modalClose).forEach(closeSymbol => {
  closeSymbol.addEventListener('click', function() {    
    this.closest('.modal').classList.remove('show');
    const modalId =  this.closest('.modal').id;
    const modal = document.querySelector('#' + modalId);
    removeModal(modal);
  });
});


$(document).ready(function () {
  $(".dropdown-menu").mouseenter(function () {
      $(".dropdown-content:not(:animated)").slideDown("fast");
  });
  $(".dropdown-menu").mouseleave(function () {
      $(".dropdown-content").delay(100).slideUp("fast");
  });

  document.addEventListener('click', function (e) {
    if(e.target.classList.contains('modal')){
      Array.from(document.querySelectorAll('.modal')).forEach(modal => {
        modal.classList.remove('show');
        removeModal(modal);
      });
    }
  }, false);
  
  if(typeof $(document).tooltip !== 'undefined' && $.isFunction($(document).tooltip)) {
    $(document).tooltip({
      position: {
        at: 'left-8 bottom+5',
        my: 'left top',
        using: function(position, feedback) {
          $(this).css(position);
          $(this).addClass(feedback.vertical);
        }
      },
      content: function () {
        return $(this).prop('title');
      },
    });
  }

  // COLLAPSE
  $(".collapse-toggle").on("click", function() {
    $(this).toggleClass("active");
    $(this).next().slideToggle(200);
  });

  // NOTIFICATION
  $(".notification").click(function () {
      var alertTarget = this.id;

    setTimeout(function(){
      $('[data-alert="' + alertTarget + '"]').detach().appendTo(".notification-content").fadeIn();
    }, 200);
    
    setTimeout(function(){
      $('[data-alert="' + alertTarget + '"]').fadeOut();
    }, 3000);
  });

  $(".alert .close").click(function () {
    $(this).parents('.alert').fadeOut();
  })
});