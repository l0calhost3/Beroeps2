// Scroll
const next = document.getElementById("button-next");
const prev = document.getElementById("button-prev");
const image = document.getElementById("image");

let images = [
    "../images/image.png",
    "../images/yaroslav.png",
    "../images/niels.png",
    "../images/sven.png",
    "../images/christiaan.png",
];

let currentImage = 0;

if (next && prev && image) {
    next.addEventListener("click", () => {
        image.style.opacity = "0";

        setTimeout(() => {
            currentImage = (currentImage + 1) % images.length;
            image.src = images[currentImage];
            image.style.opacity = "1";
        }, 300);
    });
    prev.addEventListener("click", () => {
        image.style.opacity = "0";

        setTimeout(() => {
            currentImage = (currentImage - 1 + images.length) % images.length;
            image.src = images[currentImage];
            image.style.opacity = "1";
        }, 300);
    });
}

// Big image
const recipeModal = document.querySelector('#recipe-modal');

if (recipeModal) {
	const modalImage = recipeModal.querySelector('.recipe-modal-image');
	const modalTitle = recipeModal.querySelector('#recipe-modal-title');
	const modalText = recipeModal.querySelector('.recipe-modal-text p');
	const closeButton = recipeModal.querySelector('.recipe-modal-close');
	const recipeCards = document.querySelectorAll('.recipe-card');

	const closeRecipeModal = () => {
		recipeModal.hidden = true;
		document.body.classList.remove('modal-open');
	};

	recipeCards.forEach((card) => {
		card.tabIndex = 0;

		const openRecipeModal = () => {
			const image = card.querySelector('img');
			const title = card.querySelector('h2');
			const description = card.querySelector('p');

			if (!image || !title || !description) {
				return;
			}

			modalImage.src = image.src;
			modalImage.alt = image.alt;
			modalTitle.textContent = title.textContent;
			modalText.textContent = description.textContent;
			recipeModal.hidden = false;
			document.body.classList.add('modal-open');
			closeButton.focus();
		};

		card.addEventListener('click', openRecipeModal);
		card.addEventListener('keydown', (event) => {
			if (event.key === 'Enter' || event.key === ' ') {
				event.preventDefault();
				openRecipeModal();
			}
		});
	});

	closeButton.addEventListener('click', closeRecipeModal);
	recipeModal.addEventListener('click', (event) => {
		if (event.target === recipeModal) {
			closeRecipeModal();
		}
	});
	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && !recipeModal.hidden) {
			closeRecipeModal();
		}
	});
}



// Recipe filter and search
const recipeFilters = document.querySelector('.recipe-filters');

if (recipeFilters) {
    const filterButtons = recipeFilters.querySelectorAll('.recipe-filter');
    const searchInput = recipeFilters.querySelector('#recipe-search');
    const recipeCards = document.querySelectorAll('.recipe-card');
    const noResults = document.querySelector('.recipe-no-results');
    let selectedCategory = 'all';

    const filterRecipes = () => {
        const searchTerm = searchInput.value.trim().toLocaleLowerCase();
        let visibleRecipes = 0;

        recipeCards.forEach((card) => {
            const title = card.querySelector('h2');
            const matchesCategory = selectedCategory === 'all' || card.dataset.category === selectedCategory;
            const matchesSearch = title && title.textContent.toLocaleLowerCase().includes(searchTerm);
            const isVisible = matchesCategory && matchesSearch;

            card.hidden = !isVisible;
            if (isVisible) {
                visibleRecipes += 1;
            }
        });

        noResults.hidden = visibleRecipes > 0;
    };

    filterButtons.forEach((button) => {
        button.addEventListener('click', () => {
            selectedCategory = button.dataset.category;
            filterButtons.forEach((filterButton) => {
                filterButton.classList.toggle('active', filterButton === button);
            });
            filterRecipes();
        });
    });

    searchInput.addEventListener('input', filterRecipes);
    filterRecipes();
}
