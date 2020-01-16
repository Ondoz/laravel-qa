CKEDITOR.editorConfig = function(config) {
    (config.extraPlugins = "codesnippet"), "easyimage";
    // config.toolbar = [
    //     { name: "basicstyles", items: ["Bold", "Italic"] },
    //     {
    //         name: "paragraph",
    //         items: ["NumberedList", "BulletedList", "-", "Outdent", "Indent"]
    //     },
    //     { name: "links", items: ["Link", "Unlink"] },
    //     { name: "insert", items: ["EasyImageUpload", "codesnippet"] }
    // ];
    config.codeSnippet_theme = "monokai_sublime";
};
