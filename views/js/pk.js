const renderPokemonInfo = (pokemon) => {
    const { sprite, name, moves, abilities, types } = pokemon;

    document.getElementById("sprite").setAttribute("src", sprite);
    document.getElementById("name").textContent = name;

    const renderList = (items, property, containerId) => {
        const container = document.getElementById(containerId);
        const ul = document.createElement("ul");
        items.forEach((item) => {
            const li = document.createElement("li");
            li.textContent = item[property];
            ul.appendChild(li);
        });
        container.appendChild(ul);
    };

    renderList(moves, "move", "moves");
    renderList(abilities, "ability", "abilities");
    renderList(types, "type", "types");
};

const fetchPokemonData = async (pokemonName) => {
    try {
        const response = await fetch(`http://localhost/easyapiphp/api.php/pokemon?name=${pokemonName}`);
        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.status} - ${response.statusText}`);
        }
        const pokemon = await response.json();
        renderPokemonInfo(pokemon);
    } catch (error) {
        console.error("Fetch error:", error);
    }
};

const urlParams = new URLSearchParams(window.location.search);
const pokemonName = urlParams.get("Pokemon") || "";
fetchPokemonData(pokemonName);
