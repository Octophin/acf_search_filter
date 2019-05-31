let showFilters = function () {

    let selected = document.getElementById("type").value;

    document.querySelectorAll("[data-filter-type]").forEach(function (element) {

        if (element.getAttribute("data-filter-type") === selected) {

            element.style.display = "block";

        } else {

            element.style.display = "none";

        }


    });

};

let runCpf = function (config) {

    document.getElementById("type").addEventListener("change", showFilters);

    showFilters();

    document.getElementById("cpf-search").addEventListener("click", function () {

        let search = {
            type: document.getElementById("type").value,
            filters: []
        };

        search.keywords = document.getElementById("keywords").value;

        document.querySelectorAll("[data-filter-type=" + search.type + "] select").forEach(function (dropdown) {

            let key = dropdown.getAttribute("name");
            let value = dropdown.options[dropdown.selectedIndex].value;

            if (value) {

                search.filters.push({
                    key: key,
                    value: value
                });

            }

        });

        let searchWithin = config[search.type].posts;

        let output = searchWithin.filter(function (item) {

            let show = true;

            search.filters.forEach(function (filter) {

                if (item[filter.key] !== filter.value) {

                    show = false;

                }

            });

            return show;

        });

        // Finally filter by keywords

        output = output.filter(function (item) {

            return item.title.toLowerCase().indexOf(search.keywords) !== -1;

        });

        let message = "";

        if (output.length === 0) {

            message += "No results. Change your search terms and try again.";

        } else if (output.length === 1) {

            message += "One result";

        } else {

            message += output.length + " results";

        }

        document.getElementById("count").innerHTML = message;

        let results = "";

        output.forEach(function (result) {

            results += "<li><a href='" + result.link + "'>" + result.title + "</a></li>";

        });

        document.getElementById("results-list").innerHTML = results;

    });

};
