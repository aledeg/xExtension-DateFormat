# xExtension-DateFormat
A FreshRSS extension to format dates

When enabled, users will be able to format dates in the interface.
There are different options to handle the date:
- Display the dates relative to the browser current date,
- Display the dates adjusted to the browser current date,
- Display the dates in 12-hours format,
- Display the dates with a custom format.

> The custom format must follow the format supported by the `moment.js` library.
> For more information, please check the `moment.js` [format documentation](https://momentjs.com/docs/#/displaying/format/).

> If you want to introduce a carriage return (`\n`) in the date, you must enclose it between square brackets (example: `HH:mm[\n]D/M/YYYY`).
> This alone won't display it since the browser will ignore them by default.
> Thus you need to add a CSS rule to override that behavior:
> ```css
> .item.date time {
>     white-space: pre;
> }
> ```

**Note:**  
There is a conflit with the "Mobile scroll menu" extension which prevents the date formatting on pages loaded in the background.
It seems to occur only when using Firefox though.
