/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here.
    // For complete reference see:
    // https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbarGroups = [
        { name: "clipboard", groups: ["clipboard", "undo"] },
        {
            name: "editing",
            groups: ["find", "selection", "spellchecker", "editing"]
        },
        { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
        { name: "insert", groups: ["insert"] },
        { name: "links", groups: ["links"] },
        { name: "forms", groups: ["forms"] },
        { name: "tools", groups: ["tools"] },
        { name: "document", groups: ["mode", "document", "doctools"] },
        { name: "others", groups: ["others"] },
        {
            name: "paragraph",
            groups: ["list", "indent", "blocks", "align", "bidi", "paragraph"]
        },
        { name: "styles", groups: ["styles"] },
        { name: "colors", groups: ["colors"] },
        { name: "about", groups: ["about"] }
    ];
    config.extraPlugins = "codesnippet";
    config.removeButtons =
        "Underline,Subscript,Superscript,Cut,Copy,Paste,,Undo,Redo,PasteText,PasteFromWord,Scayt,Link,Unlink,Anchor,Table,HorizontalRule,SpecialChar,Source,Indent,Outdent,About,RemoveFormat,ImageInfo";

    // Set the most common block elements.
    config.format_tags = "p;h1;h2;h3;pre";

    // Simplify the dialog windows.
    config.removeDialogTabs = "image:advanced;link:advanced";
    config.codeSnippet_theme = "monokai_sublime";
    config.codeSnippet_languages = {
        javascript: "JavaScript",
        php: "PHP"
    };
};
