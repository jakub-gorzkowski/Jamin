const search = document.querySelector('input[placeholder="Search"]');
const searchButton = document.getElementById('search-button');
const eventContainer = document.querySelector(".output");

function handleSearch() {
    const data = { search: search.value };

    fetch("searchEvent", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (events) {
        eventContainer.innerHTML = '';
        loadEvents(events);
        const resultsSection = document.querySelector("h2");
        resultsSection.style.opacity = '1';
    });
}


searchButton.addEventListener("click", handleSearch);

search.addEventListener("keyup", function(event){
    if (event.key === "Enter" || event.target === searchButton) {
        event.preventDefault();

        const data = {search: this.value};

        handleSearch();
    }
});

function loadEvents(events) {
    events.forEach(event => {
        console.log(event);
        createEvent(event);
    });
}

function createEvent(event) {
    const template = document.querySelector("#event-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${event.image}`;

    const name = clone.querySelector("h3");
    name.innerHTML = event.name;

    const description = clone.querySelector("article");
    description.innerHTML = event.description;

    const location = clone.querySelector("div.location-content");
    location.innerHTML = event.location_name;

    const category = clone.querySelector("div.category-content");
    category.innerHTML = event.category_name;

    const min_price = clone.querySelector("div.min-price");
    min_price.innerHTML = parseInt(event.min_price);

    const max_price = clone.querySelector("div.max-price");
    max_price.innerHTML = parseInt(event.max_price);

    eventContainer.appendChild(clone);
}