import adapter from 'sveltekit-adapter-wordpress-shortcode';
import { vitePreprocess } from '@sveltejs/kit/vite';

/** @type {import('@sveltejs/kit').Config} */
const config = {
  // Consult https://kit.svelte.dev/docs/integrations#preprocessors
  // for more information about preprocessors
  preprocess: vitePreprocess(),

  kit: {
    // adapter-auto only supports some environments, see https://kit.svelte.dev/docs/adapter-auto for a list.
    // If your environment is not supported or you settled on a specific environment, switch out the adapter.
    // See https://kit.svelte.dev/docs/adapters for more information about adapters.
    adapter: adapter({
      pages: 'build',
      assets: 'build',
      fallback: null,
      indexPath: 'index.php',
      shadow: false,
      shortcode: 'svelte-kit-shortcode',
      prefix: 'skawpsc_svelte_kit_shortcode',
      renderHead: (head) =>
        [...head.querySelectorAll(`link[rel="modulepreload"]`)]
          .map((element) => element.outerHTML)
          .join(''),
      renderBody: (body) => body.innerHTML
    })
  }
};
// handle wordpress url structure
if (process.env.NODE_ENV === "production") {
	const base = "/wp-content/plugins/my-shortcode-plugin"
	config.kit.paths = {
		base,
		assets: "https://evqaristia.ge" + base
	}
}
export default config;
