<section id="cpf">

    <label for="keyword">Keywords</label>
    <input id="keywords" name="keywords" type="search" /><br />

    <label for="type">Category</label><select id="type">
        <?php

foreach(array_keys($postTypeList) as $type){

    echo "<option value='" . $type . "'>" . $type . "</option>";
    
}

        ?>
    
    </select>

    <?php 
    
    foreach($postTypeList as $type => $details){

        echo '<section data-filter-type="' . $type . '" class="filters">';
        
            foreach($details["filters"] as $fieldName => $values){

                echo "<label for='".$fieldName."'>" . $fieldName . "</label>";

                echo "<select name='".$fieldName."'>";

                echo "<option value='' selected=selected>Select</option>";

                foreach($values as $value){

                    echo "<option value='" . $value . "'>" . $value . "</option>";

                }

                echo "</select>";

            }

        echo '</section>';

    };

    ?>

    <button id="cpf-search" type='button'>Search</button>

    <div id="results">

        <div id="count"></div>

        <ul id="results-list">

            

        </ul>

    </div>

</section>