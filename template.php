<section id="cpf">

    <!-- Generate styles to show and hide elements -->

    <style>
        <?php

        foreach ($groups as $groupName => $groupDetails) {

            echo "\n";

            echo "#cpf[data-current-group='" .  $groupName . "'] [data-group='" . $groupName . "'] {

                display:block;

            }";

            echo "\n";

            foreach (array_keys($groupDetails) as $contentType) {

                echo "\n";

                echo "#cpf[data-current-type='" .  $contentType . "'] [data-type='" . $contentType . "'] {

                    display:block;

                }";

                echo "\n";
            }
        }

        ?>
    </style>



    <!-- Keyword search - works across all areas -->
    <label for="keyword">Keywords</label>
    <input id="cpf-keywords" name="keywords" type="search" /><br />

    <?php

    // Loop over groups to create a groups dropdown

    echo "<select id='cpf-groups' onchange='refreshCPF()'>";

    echo "<option value=''>Category</option>";

    foreach (array_keys($groups) as $groupName) {

        echo "<option value='" . $groupName . "'>" . $groupName . "</option>";
    }

    echo "</select>";

    // Make an area for that group's select to sit

    foreach ($groups as $groupName => $contentTypes) {

        echo "<section data-group='" . $groupName . "'>";

        // Add select for each content type

        echo "<select class='typeChange' onchange='refreshCPF()'>";

        echo "<option value=''>All</option>";

        foreach (array_keys($contentTypes) as $contentType) {

            echo "<option value='" . $contentType . "'>" . $contentType . "</option>";
        }

        echo "</select>";

        foreach ($contentTypes as $contentTypeLabel => $contentType) {

            // Add extra sub-sections for each content type

            echo '<section data-type="' . $contentTypeLabel . '" class="filters">';

            foreach ($contentType["filters"] as $fieldName => $values) {

                echo "<label for='" . $fieldName . "'>" . $fieldName . "</label>";

                echo "<select name='" . $fieldName . "'>";

                echo "<option value='' selected=selected>Select</option>";

                foreach ($values as $value) {

                    echo "<option value='" . $value . "'>" . $value . "</option>";
                }

                echo "</select>";
            }

            echo '</section>';
        }

        echo "</section>";
    }

    ?>

    <section id="cpf-submit-and-results">

        <button onclick='searchCPF()' id="search-cpf" type='button'>Search</button>

        <div id="results">

            <div id="count"></div>

            <ul id="results-list">



            </ul>

        </div>

    </section>

</section>