<script>
	import { onMount } from 'svelte';

	let userData = {};

	$: name = userData?.name || '';

	onMount(async () => {
		const me = await fetch('/api/me');

		if (me.ok) {
			userData = await me.json();
		}else{
			userData = {name: 'Ismeretlen'};
		}

		
	});
</script>

<div class="center">
	<h2>Szia {name}!</h2>
	<a href="/info">php_info()</a>
	<section>
		<pre>{JSON.stringify(userData, null, 2)}</pre>
	</section>
</div>

<style>
	* {
		margin: 0;
	}

	.center {
		min-height: 100vh;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	h2 {
		letter-spacing: 5px;
	}
</style>
