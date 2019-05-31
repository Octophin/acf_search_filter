# ACF Search Filter

Enable module, create some content types, add some ACF fields to them.

Then run `cpf_print()` with some options.

Type is the content type. Fields are the fields you want to filter by.

```PHP

$options = array(
    "content" => array(
        array(
            "type" => "guitar",
            "fields" => array("colour", "size")
        ),
        array(
            "type" => "drum",
            "fields" => array("loudness", "cymbals")
        ),
        array(
            "type" => "keyboard",
            "fields" => array("octaves", "electric")
        )
    )
);

cpf_print($options);

```
