<!-- Colors Modal -->
<script>
    $('#remove-background').click(function(e)
    {
        e.preventDefault();
        $('.color-container').hide();
        $('.image-container').hide();
        $('#image').val('');
        $('#color').val('');
    });
    $('img').click(function() {
        image = document.getElementById('image');

        var img = $(this).attr('src');
        image.value = img;
        $('#bg_image').val(img);
        $(".modal-img-list").addClass("hidden");
        $(this).parent().children(".modal-img-list").removeClass("hidden");
    });

    $('#select_image').click(function(e)
    {
        var bg_image = $('#bg_image').val();
        $('.image-container').show();
        $('#bg_image').val(bg_image);
        $('.color-container').hide();
        $('#color').val('');
        $('#bg-image').attr('src', bg_image);
        modalWrapper.classList.add("hidden");
    });

    const colours = [{
            name: 'white',
            hex: '#FFFFFF'
        },

        {
            name: 'whitesmoke',
            hex: '#F5F5F5'
        },
        {
            name: 'seashell',
            hex: '#FFF5EE'
        },
        {
            name: 'beige',
            hex: '#F5F5DC'
        },
        {
            name: 'oldlace',
            hex: '#FDF5E6'
        },
        {
            name: 'floralwhite',
            hex: '#FFFAF0'
        },
        {
            name: 'ivory',
            hex: '#FFFFF0'
        },
        {
            name: 'antiquewhite',
            hex: '#FAEBD7'
        },
        {
            name: 'linen',
            hex: '#FAF0E6'
        },
        {
            name: 'lavenderblush',
            hex: '#FFF0F5'
        },
        {
            name: 'mistyrose',
            hex: '#FFE4E1'
        },
        {
            name: 'gainsboro',
            hex: '#DCDCDC'
        },
        {
            name: 'lightgray',
            hex: '#D3D3D3'
        },
        {
            name: 'silver',
            hex: '#C0C0C0'
        },
        {
            name: 'darkgray',
            hex: '#A9A9A9'
        },
        {
            name: 'gray',
            hex: '#808080'
        },
        {
            name: 'dimgray',
            hex: '#696969'
        },
        {
            name: 'lightslategray',
            hex: '#778899'
        },
        {
            name: 'slategray',
            hex: '#708090'
        },
        {
            name: 'darkslategray',
            hex: '#2F4F4F'
        },
        {
            name: 'black',
            hex: '#000000'
        },
        {
            name: 'cornsilk',
            hex: '#FFF8DC'
        },
        {
            name: 'blanchedalmond',
            hex: '#FFEBCD'
        },
        {
            name: 'bisque',
            hex: '#FFE4C4'
        },
        {
            name: 'navajowhite',
            hex: '#FFDEAD'
        },
        {
            name: 'wheat',
            hex: '#F5DEB3'
        },
        {
            name: 'burlywood',
            hex: '#DEB887'
        },
        {
            name: 'tan',
            hex: '#D2B48C'
        },
        {
            name: 'rosybrown',
            hex: '#BC8F8F'
        },
        {
            name: 'sandybrown',
            hex: '#F4A460'
        },
        {
            name: 'goldenrod',
            hex: '#DAA520'
        },
        {
            name: 'peru',
            hex: '#CD853F'
        },
        {
            name: 'chocolate',
            hex: '#D2691E'
        },
        {
            name: 'saddlebrown',
            hex: '#8B4513'
        },
        {
            name: 'sienna',
            hex: '#A0522D'
        },
        {
            name: 'brown',
            hex: '#A52A2A'
        },
        {
            name: 'maroon',
            hex: '#800000'
        },
        {
            name: 'lightyellow',
            hex: '#FFFFE0'
        },
        {
            name: 'lemonchiffon',
            hex: '#FFFACD'
        },
        {
            name: 'lightgoldenrodyellow',
            hex: '#FAFAD2'
        },
        {
            name: 'papayawhip',
            hex: '#FFEFD5'
        },
        {
            name: 'moccasin',
            hex: '#FFE4B5'
        },
        {
            name: 'peachpuff',
            hex: '#FFDAB9'
        },
        {
            name: 'palegoldenrod',
            hex: '#EEE8AA'
        },
        {
            name: 'khaki',
            hex: '#F0E68C'
        },
        {
            name: 'darkkhaki',
            hex: '#BDB76B'
        },
        {
            name: 'yellow',
            hex: '#FFFF00'
        },
        {
            name: 'lightsalmon',
            hex: '#FFA07A'
        },
        {
            name: 'salmon',
            hex: '#FA8072'
        },
        {
            name: 'darksalmon',
            hex: '#E9967A'
        },
        {
            name: 'lightcoral',
            hex: '#F08080'
        },
        {
            name: 'indianred',
            hex: '#CD5C5C'
        },
        {
            name: 'crimson',
            hex: '#DC143C'
        },
        {
            name: 'firebrick',
            hex: '#B22222'
        },
        {
            name: 'red',
            hex: '#FF0000'
        },
        {
            name: 'darkred',
            hex: '#8B0000'
        },
        {
            name: 'coral',
            hex: '#FF7F50'
        },
        {
            name: 'tomato',
            hex: '#FF6347'
        },
        {
            name: 'orangered',
            hex: '#FF4500'
        },
        {
            name: 'gold',
            hex: '#FFD700'
        },
        {
            name: 'orange',
            hex: '#FFA500'
        },
        {
            name: 'darkorange',
            hex: '#FF8C00'
        },
        {
            name: 'lawngreen',
            hex: '#7CFC00'
        },
        {
            name: 'chartreuse',
            hex: '#7FFF00'
        },
        {
            name: 'limegreen',
            hex: '#32CD32'
        },
        {
            name: 'lime',
            hex: '#00FF00'
        },
        {
            name: 'forestgreen',
            hex: '#228B22'
        },
        {
            name: 'green',
            hex: '#008000'
        },
        {
            name: 'darkgreen',
            hex: '#006400'
        },
        {
            name: 'greenyellow',
            hex: '#ADFF2F'
        },
        {
            name: 'yellowgreen',
            hex: '#9ACD32'
        },
        {
            name: 'springgreen',
            hex: '#00FF7F'
        },
        {
            name: 'mediumspringgreen',
            hex: '#00FA9A'
        },
        {
            name: 'lightgreen',
            hex: '#90EE90'
        },
        {
            name: 'palegreen',
            hex: '#98FB98'
        },
        {
            name: 'darkseagreen',
            hex: '#8FBC8F'
        },
        {
            name: 'mediumseagreen',
            hex: '#3CB371'
        },
        {
            name: 'seagreen',
            hex: '#2E8B57'
        },
        {
            name: 'olive',
            hex: '#808000'
        },
        {
            name: 'darkolivegreen',
            hex: '#556B2F'
        },
        {
            name: 'olivedrab',
            hex: '#6B8E23'
        },
        {
            name: 'lightcyan',
            hex: '#E0FFFF'
        },
        {
            name: 'cyan',
            hex: '#00FFFF'
        },
        {
            name: 'aqua',
            hex: '#00FFFF'
        },
        {
            name: 'aquamarine',
            hex: '#7FFFD4'
        },
        {
            name: 'mediumaquamarine',
            hex: '#66CDAA'
        },
        {
            name: 'paleturquoise',
            hex: '#AFEEEE'
        },
        {
            name: 'turquoise',
            hex: '#40E0D0'
        },
        {
            name: 'mediumturquoise',
            hex: '#48D1CC'
        },
        {
            name: 'darkturquoise',
            hex: '#00CED1'
        },
        {
            name: 'lightseagreen',
            hex: '#20B2AA'
        },
        {
            name: 'cadetblue',
            hex: '#5F9EA0'
        },
        {
            name: 'darkcyan',
            hex: '#008B8B'
        },
        {
            name: 'teal',
            hex: '#008080'
        },
        {
            name: 'powderblue',
            hex: '#B0E0E6'
        },
        {
            name: 'lightblue',
            hex: '#ADD8E6'
        },
        {
            name: 'lightskyblue',
            hex: '#87CEFA'
        },
        {
            name: 'skyblue',
            hex: '#87CEEB'
        },
        {
            name: 'deepskyblue',
            hex: '#00BFFF'
        },
        {
            name: 'lightsteelblue',
            hex: '#B0C4DE'
        },
        {
            name: 'dodgerblue',
            hex: '#1E90FF'
        },
        {
            name: 'cornflowerblue',
            hex: '#6495ED'
        },
        {
            name: 'steelblue',
            hex: '#4682B4'
        },
        {
            name: 'royalblue',
            hex: '#4169E1'
        },
        {
            name: 'blue',
            hex: '#0000FF'
        },
        {
            name: 'mediumblue',
            hex: '#0000CD'
        },
        {
            name: 'darkblue',
            hex: '#00008B'
        },
        {
            name: 'navy',
            hex: '#000080'
        },
        {
            name: 'midnightblue',
            hex: '#191970'
        },
        {
            name: 'mediumslateblue',
            hex: '#7B68EE'
        },
        {
            name: 'slateblue',
            hex: '#6A5ACD'
        },
        {
            name: 'darkslateblue',
            hex: '#483D8B'
        },
        {
            name: 'lavender',
            hex: '#E6E6FA'
        },
        {
            name: 'thistle',
            hex: '#D8BFD8'
        },
        {
            name: 'plum',
            hex: '#DDA0DD'
        },
        {
            name: 'violet',
            hex: '#EE82EE'
        },
        {
            name: 'orchid',
            hex: '#DA70D6'
        },
        {
            name: 'fuchsia',
            hex: '#FF00FF'
        },
        {
            name: 'magenta',
            hex: '#FF00FF'
        },
        {
            name: 'mediumorchid',
            hex: '#BA55D3'
        },
        {
            name: 'mediumpurple',
            hex: '#9370DB'
        },
        {
            name: 'blueviolet',
            hex: '#8A2BE2'
        },
        {
            name: 'darkviolet',
            hex: '#9400D3'
        },
        {
            name: 'darkorchid',
            hex: '#9932CC'
        },
        {
            name: 'darkmagenta',
            hex: '#8B008B'
        },
        {
            name: 'purple',
            hex: '#800080'
        },
        {
            name: 'indigo',
            hex: '#4B0082'
        },
        {
            name: 'pink',
            hex: '#FFC0CB'
        },
        {
            name: 'lightpink',
            hex: '#FFB6C1'
        },
        {
            name: 'hotpink',
            hex: '#FF69B4'
        },
        {
            name: 'deeppink',
            hex: '#FF1493'
        },
        {
            name: 'palevioletred',
            hex: '#DB7093'
        },
        {
            name: 'mediumvioletred',
            hex: '#C71585'
        }
    ];

    const palette = document.getElementById('palette'),
        nameSpan = document.getElementById('name'),
        hexSpan = document.getElementById('hex');
    color = document.getElementById('color');

    palette.onclick = e => {
        const li = e.target;
        nameSpan.innerHTML = li.dataset.name;
        hexSpan.innerHTML = li.dataset.hex;
        color.value = li.dataset.hex;
        hexSpan.style.backgroundColor = li.dataset.hex;
        if (palette.active) palette.active.className = palette.active.className.replace(' active', '');
        palette.active = li;
        li.className += ' active';
        $('#hex_color').val(li.dataset.hex);
    };

    $('#select_color').click(function(e)
    {
        var hex_color = $('#hex_color').val();
        $('#image').val('');
        $('.image-container').hide();
        $('.color-container').show();
        $(".color-container").css("background-color", hex_color);
        modalWrapper.classList.add("hidden");
    });




    colours.forEach(color => {
        const li = document.createElement('li');
        li.title = color.name;
        li.style.backgroundColor = color.hex;
        li.style.border = "1px solid black";
        li.dataset.name = color.name;
        li.dataset.hex = color.hex;
        palette.appendChild(li);

    });
</script>