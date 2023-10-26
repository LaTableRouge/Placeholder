# [The Placeholder](https://placeholder.mlnop.fr)

<img src="https://img.shields.io/badge/php-%5E7.3-blue">
<img src="https://img.shields.io/badge/node-%3E%3D%2016-brightgreen">

Welcome to The Placeholder! This project is a simple web application that allows you to display a random picture from a custom library. You can also customize the dimensions of the displayed picture by passing URL parameters.

[Live preview](https://placeholder.mlnop.fr)

## Folder Organization

- index.php
- 📁assets
    - 📁img
        - Different folders of pictures based on how many libraries you have

## Prerequisites

### Pathing

Change the path of your pictures inside the [index.php](index.php) file.

### Minify Pictures

If you want to minify your pictures, there is a [webpack.mix.js](webpack.mix.js) file that can do that.

1. Install dependencies:

   ```bash
   npm install
   ```

2. Verify the path of src/dest files inside [webpack.mix.js](webpack.mix.js).

3. Start the minification process:

   ```bash
   npm run dev
   ```

## Usage

Open the URL where you put the project and enjoy! Refresh for another random picture.

### Custom Dimensions

You can also customize the dimensions of the displayed picture by using URL parameters. Here's how:

- `size`: specify the size of the displayed picture in pixels.

For example, to display a picture with a width of 800 pixels and a height of 600 pixels, use the following URL format:

```
https://placeholder.mlnop.fr/?size=800/600
```

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
