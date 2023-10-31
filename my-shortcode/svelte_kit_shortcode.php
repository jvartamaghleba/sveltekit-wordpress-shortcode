<?php

function skawpsc_svelte_kit_shortcode_shortcodeHead() {
    return file_get_contents(plugin_dir_path( __FILE__ ) . "svelte_kit_shortcode_head.html");
}

function skawpsc_svelte_kit_shortcode_shortcodeBody() {
    return file_get_contents(plugin_dir_path( __FILE__ ) . "svelte_kit_shortcode_body.html");
}

function skawpsc_svelte_kit_shortcode_shortcodeData($attributes, $content) {
    $jsonAttributes = json_encode($attributes);
    return <<<HTML
        <script id="svelte-kit-shortcode-attributes" type="application/json">
            {$jsonAttributes}
        </script>
        <template id="svelte-kit-shortcode-content">
            {$content}
        </template>
    HTML;
}

add_shortcode("svelte-kit-shortcode", function ($attributes, $content) {
    $injection = skawpsc_svelte_kit_shortcode_shortcodeData($attributes, $content) .  skawpsc_svelte_kit_shortcode_shortcodeBody();

    if (false) {
        $injection .= skawpsc_svelte_kit_shortcode_shortcodeHead();
        return <<<HTML
            <template id="svelte-kit-shortcode-template">
                {$injection}
            </template>
            <div id="svelte-kit-shortcode-container"></div>
            <script>
                document
                    .querySelector("#svelte-kit-shortcode-container")
                    .attachShadow({ mode: "open" })
                    .appendChild(document.querySelector("#svelte-kit-shortcode-template").content)
            </script>
         HTML;
    } else {
        return $injection;
    }
});

add_action("wp_head", function () {
    if (false) return;

    global $post;
    if (!has_shortcode($post->post_content, "svelte-kit-shortcode")) return;

    echo skawpsc_svelte_kit_shortcode_shortcodeHead();
});

?>
