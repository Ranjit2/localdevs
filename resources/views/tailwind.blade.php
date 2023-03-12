<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

	<div class="container mx-auto mt-5">
		<div class="bg-white mb-4 border-solid border-2 border-grey-600 rounded-md">
			<div class="p-4 md:p-6 lg:p-8 flex items-center">
				<div class="md:w-1/4">
					<div class="w-32 h-32 rounded-full overflow-hidden">
						<img src="https://via.placeholder.com/150x150" alt="Profile picture" class="w-full h-full object-cover">
					</div>
				</div>
				<div class="md:w-3/4 pl-4 md:pl-6 lg:pl-8">
					<h3 class="text-xl font-semibold mb-2">John Doe</h3>
					<h5 class="text-gray-600 mb-4">Developer</h5>
					<p class="text-gray-800 leading-relaxed mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vel risus commodo, faucibus ipsum nec, bibendum justo. Nullam mattis orci vel quam imperdiet bibendum.</p>
					<div class="flex flex-wrap">
						<span class="text-xs font-semibold bg-blue-100 text-grey-600 py-1 px-2 rounded-full mr-2 mb-2">PHP</span>
						<span class="text-xs font-semibold bg-blue-100 text-grey-600 py-1 px-2 rounded-full mr-2 mb-2">CSS</span>
						<span class="text-xs font-semibold bg-blue-100 text-grey-600 py-1 px-2 rounded-full mr-2 mb-2">HTML</span>
					</div>
				</div>

			</div>
			<div class="border-t border-gray-200 p-4 md:p-6 lg:p-8">
				<div class="flex justify-center">
					<a href="#" class="mr-4">
						<i class="fas fa-user fa-lg text-gray-600 hover:text-blue-600"></i>
					</a>
					<a href="#" class="mr-4">
						<svg class="w-9 h-9 align-bottom hover:text-blue-600"" fill=" none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
						</svg> </a>
					<a href="#" class="">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h8l2 2v-2h8V8h-8V6l-2 2H4v4z" />
						</svg>

					</a>
				</div>
			</div>
		</div>
	</div>

</body>

</html>