import './menu.js';

class WorkshopDirectory {
	constructor(directory) {
		this.directory = directory;
		this.cards = Array.from(directory.querySelectorAll('[data-workshop-card]'));
		this.filters = Array.from(directory.querySelectorAll('[data-workshop-filter]'));
		this.count = directory.querySelector('[data-workshop-count]');
		this.summary = directory.querySelector('[data-workshop-summary]');
		this.init();
	}

	init() {
		this.filters.forEach((filter) => {
			filter.addEventListener('change', () => this.filterCards());
		});
	}

	filterCards() {
		const selected = Object.fromEntries(
			this.filters.map((filter) => [filter.dataset.workshopFilter, filter.value])
		);

		let visibleCount = 0;

		this.cards.forEach((card) => {
			const matches = this.filters.every((filter) => {
				const value = selected[filter.dataset.workshopFilter];
				return !value || card.dataset[filter.dataset.workshopFilter] === value;
			});

			card.hidden = !matches;
			if (matches) visibleCount += 1;
		});

		const hasFilter = Object.values(selected).some(Boolean);
		const label = hasFilter ? 'Filtered workshops' : 'All workshops';

		this.count.textContent = `${label} · ${visibleCount} ${visibleCount === 1 ? 'craft' : 'crafts'} to explore`;
		this.summary.textContent = `${visibleCount} of ${this.cards.length} workshops`;
	}
}

class General {
	constructor() {
		this.testVariable = 'script working';
		this.init();
	}

	init() {
		// for tests purposes only
		console.log(this.testVariable);
		document.querySelectorAll('[data-workshop-directory]').forEach((directory) => {
			new WorkshopDirectory(directory);
		});
	}
}

document.addEventListener('DOMContentLoaded', () => {
	new General();
});
