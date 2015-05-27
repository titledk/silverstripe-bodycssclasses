# silverstripe-bodycssclasses
Helper for page / controller specific styling, adding the class and parent classes of your
pages to your body element. E.g. a `CustomCalendarPage` that extends `CalendarPage`
would produce `CustomCalendarPage CalendarPage Page`.

That way any specific styles for `CalendarPage` will also apply for `CustomCalendarPage`.


## Installation

Install via composer and add `$BodyCssClasses` to your body or, wherever you want it.

E.g.:

```html
<body class="$BodyCssClasses">

</body>
```
