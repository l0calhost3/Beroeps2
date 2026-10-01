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
