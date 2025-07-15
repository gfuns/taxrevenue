// /js/includes.js
document.addEventListener("DOMContentLoaded", () => {
	const loadHTML = async (selector, file) => {
		const el = document.querySelector(selector)
		if (el) {
			const res = await fetch(file)
			if (res.ok) {
				el.innerHTML = await res.text()
			} else {
				el.innerHTML = "<!-- Failed to load include -->"
			}
		}
	}

	loadHTML("#header", "/components/header.html")
	loadHTML("#footer", "/components/footer.html")
})
