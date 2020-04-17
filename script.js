// Run search everytime something changes

var refreshCPF = function () {

    // Check if a group is selected and add it as a data attribute to the top

    let group = document.getElementById("cpf-groups").value;

    document.getElementById("cpf").setAttribute("data-current-group", group);

    // If no group hide the search button

    if (!group) {

        document.getElementById("cpf-submit-and-results").style.display = "none";

    } else {

        document.getElementById("cpf-submit-and-results").style.display = "block";

    }

    if (group) {

        // Check if a content type is selected within this group and add it as a data attribute to the top

        let contentType = document.querySelector("[data-group='" + group + "'] .typeChange").value;

        document.getElementById("cpf").setAttribute("data-current-type", contentType);

    }

}

// Run on page load

refreshCPF();

var searchCPF = function () {

    let group = document.getElementById("cpf").getAttribute("data-current-group");
    let type = document.getElementById("cpf").getAttribute("data-current-type");
    let keywords = document.getElementById("cpf-keywords").value;

    // First get all content from group

    let groupContent = cpf[group];

    let posts = [];

    if (type) {

        posts = groupContent[type].posts;

    } else {

        // Type is all, search all

        for (type in groupContent) {

            posts = posts.concat(groupContent[type].posts);

        }

    }

    // Got posts, now get meta fields if any set

    var filters = [];

    if (type) {

        document.querySelectorAll(".filters[data-type='" + type + "'] select").forEach(function (filter) {

            var filterName = filter.getAttribute("name");
            var value = filter.value;

            if (value) {

                filters.push({
                    filter: filterName,
                    value: value
                });

            }

        })

    }

    // Now have keywords, filters and type. Can search posts

    // First check if we have any filters and filter out the posts that don't match

    if (filters.length) {

        filters.forEach(function (filter) {

            posts = posts.filter(function (post) {

                return post[filter.filter] === filter.value;

            })

        })

    }

    // Now filter by keyword

    // Lowercase the keywords and split by word so they can appear in any order

    keywords = keywords.toLowerCase().split(" ");

    keywords.forEach(function (word) {

        posts = posts.filter(function (post) {

            var searchable = post.title.toLowerCase();

            return searchable.indexOf(word) !== -1;

        })

    })

    // Got results. Now show!

    let message = "";

    if (posts.length === 0) {

        message += "No results. Change your search terms and try again.";

    } else if (posts.length === 1) {

        message += "One result";

    } else {

        message += output.length + " results";

    }

    document.getElementById("count").innerHTML = message;

    let results = "";

    posts.forEach(function (result) {

        results += "<li><a href='" + result.link + "'>" + result.title + "</a></li>";

    });

    document.getElementById("results-list").innerHTML = results;

}
