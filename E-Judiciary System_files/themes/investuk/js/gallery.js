let modalId = $('#image-gallery');
let modalIdkochi = $('#image-gallerykochi');
let modalIddelhi = $('#image-gallerydelhi');
let modalIdmumbai = $('#image-gallerymumbai');
let modalIddu = $('#image-gallerydu');
let modalIdawareness = $('#image-galleryawareness');
let modalIdanganwadi = $('#image-galleryanganwadi');

$(document)
  .ready(function () {

    loadGallery(true, 'a.thumbnail');
	loadGalleryKochi(true, 'a.thumbnail');
	loadGalleryDelhi(true, 'a.thumbnail');
	loadGalleryMumbai(true, 'a.thumbnail');
	loadGalleryDU(true, 'a.thumbnail');
        loadGalleryAwareness(true, 'a.thumbnail');
        loadGalleryAnganwadi(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }
		
          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
		  
        let $sel = selector;
        current_image = $sel.data('image-id');
		//alert($sel.data('image'));
        $('#image-gallery-title').text($sel.data('title'));
        $('#image-gallery-image').attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
	
	
	function loadGalleryKochi(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }
		
          selector = $('[data-image-id="' + current_image + '"]');
          updateGalleryKochi(selector);
        });
        

      function updateGalleryKochi(selector) {
		  
        let $sel = selector;
        current_image = $sel.data('image-id');
		//alert($sel.data('image'));
        $('#image-gallery-titlekochi').text($sel.data('title'));
        $('#image-gallery-imagekochi').attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }
      
     

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGalleryKochi($(this));
        });
    }
	function loadGalleryDelhi(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }
		
          selector = $('[data-image-id="' + current_image + '"]');
          updateGalleryDelhi(selector);
        });

      function updateGalleryDelhi(selector) {
		  
        let $sel = selector;
        current_image = $sel.data('image-id');
		//alert($sel.data('image'));
        $('#image-gallery-titledelhi').text($sel.data('title'));
        $('#image-gallery-imagedelhi').attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGalleryDelhi($(this));
        });
    }
	
	function loadGalleryMumbai(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }
		
          selector = $('[data-image-id="' + current_image + '"]');
          updateGalleryMumbai(selector);
        });

      function updateGalleryMumbai(selector) {
		  
        let $sel = selector;
        current_image = $sel.data('image-id');
		//alert($sel.data('image'));
        $('#image-gallery-titlemumbai').text($sel.data('title'));
        $('#image-gallery-imagemumbai').attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGalleryMumbai($(this));
        });
    }
	
	function loadGalleryDU(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }
		
          selector = $('[data-image-id="' + current_image + '"]');
          updateGalleryDU(selector);
        });

      function updateGalleryDU(selector) {
		  
        let $sel = selector;
        current_image = $sel.data('image-id');
		//alert($sel.data('image'));
        $('#image-gallery-titledu').text($sel.data('title'));
        $('#image-gallery-imagedu').attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGalleryDU($(this));
        });
    }
    
        function loadGalleryAwareness(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }
		
          selector = $('[data-image-id="' + current_image + '"]');
          updateGalleryDU(selector);
        });

      function updateGalleryAwareness(selector) {
		  
        let $sel = selector;
        current_image = $sel.data('image-id');
		//alert($sel.data('image'));
        $('#image-gallery-titleawareness').text($sel.data('title'));
        $('#image-gallery-imageawareness').attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGalleryAwareness($(this));
        });
    }
    
        function loadGalleryAnganwadi(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }
		
          selector = $('[data-image-id="' + current_image + '"]');
          updateGalleryAnganwadi(selector);
        });

      function updateGalleryAnganwadi(selector) {
		  
        let $sel = selector;
        current_image = $sel.data('image-id');
		//alert($sel.data('image'));
        $('#image-gallery-titleanganwadi').text($sel.data('title'));
        $('#image-gallery-imageanganwadi').attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGalleryAnganwadi($(this));
        });
    }
  });



// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
	 switch (e.which) {
      case 37: // left
        if ((modalIdkochi.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalIdkochi.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
	 switch (e.which) {
      case 37: // left
        if ((modalIddelhi.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalIddelhi.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
	 switch (e.which) {
      case 37: // left
        if ((modalIdmumbai.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalIdmumbai.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
	 switch (e.which) {
      case 37: // left
        if ((modalIddu.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalIddu.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    
    switch (e.which) {
      case 37: // left
        if ((modalIdawareness.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalIdawareness.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    
    switch (e.which) {
      case 37: // left
        if ((modalIdanganwadi.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalIdanganwadi.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)  
  });
  
  