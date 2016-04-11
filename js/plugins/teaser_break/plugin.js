/**
 * @file
 * Teaser break plugin.
 *
 * @ignore
 */

(function ($, Drupal, drupalSettings, CKEDITOR) {

  "use strict";

  CKEDITOR.plugins.add('teaser_break', {
    requires: 'widget',

    beforeInit: function (editor) {
      var pluginPath = this.path;

      var dtd = CKEDITOR.dtd, tagName;
      dtd['teaser-break'] = {'#': 1};
      // Register teaser-break element as allowed child, in each tag that can
      // contain a div element.
      for (tagName in dtd) {
        if (dtd[tagName].div) {
          dtd[tagName]['teaser-break'] = 1;
        }
      }
      editor.addCommand('teaser_break_insert', new TeaserBreakInsertCommand());

      editor.widgets.add('teaser_break', {
        allowedContent: 'teaser-break',
        requiredContent: 'teaser-break',
        upcast: function (element) {
          return (element.name == 'teaser-break');
        },
        init: function () {
          this.element.setHtml('<hr><div align="center"><small>Teaser-Break</small></div><hr>');
        },
        downcast: function (element) {
          element.setHtml('');
          return element;
        }
      });

      // Register the toolbar button.
      if (editor.ui.addButton) {
        editor.ui.addButton('TeaserBreak', {
          label: 'Insert teaser break',
          command: 'teaser_break_insert',
          icon: this.path + '/teaser_break.png'
       });
      }
    },

    afterInit: function (editor) {
      // Adds the comment processing rules to the data filter, so comments
      // are replaced by fake elements.
      editor.dataProcessor.dataFilter.addRules({
        comment: function (value, comment) {
          if (value == 'break') {
            return CKEDITOR.editor.createFakeElement(comment, 'cke_drupal_' + value, 'hr' );
          }
          return value;
        }
      });
    }
  });

  var TeaserBreakInsertCommand = function() {};
  TeaserBreakInsertCommand.prototype = {
    contextSensitive: 1,
    startDisabled: 1,
    exec: function( editor ) {
      editor.insertHtml(editor.document.createElement('teaser-break').getOuterHtml());
    },
    refresh: function( editor, path ) {
      if (path.elements.length <= 2) {
        this.setState( CKEDITOR.TRISTATE_OFF );
      }
      else {
        this.setState( CKEDITOR.TRISTATE_DISABLED );
      }
    }
  };

})(jQuery, Drupal, drupalSettings, CKEDITOR);
