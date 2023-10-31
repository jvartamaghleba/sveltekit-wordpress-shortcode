<script>
	import { page } from '$app/stores';
	import Books from './Books.svelte';
	import NotFound from './NotFound.svelte';

	let Component;

	const PagePath = $page.url.pathname;

	if (PagePath === '/index.php/books') {
		Component = Books;
    console.log('books')
	} else {
		Component = NotFound;
	}
</script>

<svelte:component this={Component} />
