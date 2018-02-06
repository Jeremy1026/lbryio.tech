window.lbry = {};
//document.domain = 'lbry.io';

jQuery.fn.extend({
  jFor: function() {
    var self = $(this),
        target = self.data('for') || self.attr('for');

    if (!target)
    {
      return $();
    }
    if (target instanceof jQuery) //can be set in JS
    {
      return target;
    }
    return $(target.toString());
  }
});
