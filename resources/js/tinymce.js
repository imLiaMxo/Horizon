const tinymce = require('tinymce');

require('tinymce/themes/silver');

const plugins = "table lists image autosave link media fullscreen wordcount";
for (let plugin of plugins.split(' ')) {
    require('tinymce/plugins/' + plugin);
}

$(document).ready(function() {
    tinymce.init({
        selector: 'textarea:not([no-editor])',

        plugins: plugins,
        toolbar: "undo redo | styleselect | bold italic underline strikethrough superscript subscript image link | " +
            "forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | " +
            "fontselect fontsizeselect",
        branding: false,
        menubar: false,
        relative_urls: false,
        link_title: false,

        skin: (window.matchMedia("(prefers-color-scheme: dark)").matches ? "oxide-dark" : ""),
        content_css: (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "")
    });
});