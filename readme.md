# WordPress Advanced Custom Fields filter and post search

## Created for NUS For Good by Octophin Digital

![Functionality demo](/acf_demo.gif?raw=true)

Enable module, create some content types, add some ACF fields to them.

Then run `cpf_print()` with some options.

Initial array is groups of content types. Type is the content type. Fields are the fields you want to filter by. The fields autopopulate with every value set for them into dropdowns.

```PHP

$options = [
	"Select a student" => [
				[
					"type" => "student",
					"label" => "Student",
					"fields" => [
						"Student hair colour" => "student_hair_colour", 
						"Student height" => "student_height"
					]
				],
				[
					"label" => "Student placement",
					"type" => "student_placement",
					"fields" => [
						"Placement length" => "placement_length", 
						"Placement university" => "placement_university"
					]
				],
				[
					"label" => "Student project",
					"type" => "student_project",
					"fields" => [
						"Project difficulty" => "project_difficulty", 
						"Project fun" => "project_fun"
					]
				]
	],
	"Select an organisation" => [
			[
				"label" => "Organisation",
				"type" => "org",
				"fields" => [
					"Organisation city" => "organisation_city", 
					"Organisation size" => "organisation_size"
				]

			],
			[
				"label" => "Organisation placement",
				"type" => "org_placement",
				"fields" => [
					"Placement city" => "placment_city", 
					"Placement size" => "placment_length"
				]
			],
			[
				"label" => "Organisation project",
				"type" => "org_project",
				"fields" => [
					"Project theme" => "project_theme", 
					"Project budget" => "project_budget"
				]
			]
	],
];

cpf_print($options);

```
