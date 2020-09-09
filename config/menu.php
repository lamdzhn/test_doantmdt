<?php
return [
  [
      'name' => 'Trang chủ',
      'icon' => 'fa-home',
      'route' => 'be.index'
  ],
  [
      'name' => 'Quản lý danh mục',
      'icon' => 'fa-tachometer',
      'route' => '#',
      'items' => [
          [
              'name' => 'Danh sách danh mục',
              'icon' => 'fa-circle nav-icon',
              'route' => 'be.category.index'
          ],
          [
              'name' => 'Thêm danh mục',
              'icon' => 'fa-circle nav-icon',
              'route' => 'be.category.create'
          ]
      ]
  ],
  [
     'name' => 'Quản lý sản phẩm',
     'icon' => 'fa-tachometer',
     'route' => '#',
     'items' => [
         [
             'name' => 'Danh sách sản phẩm',
             'icon' => 'fa-circle nav-icon',
             'route' => 'be.product.index'
         ],
         [
             'name' => 'Thêm sản phẩm',
             'icon' => 'fa-circle nav-icon',
             'route' => 'be.product.create'
         ]
     ]
  ],
  [
      'name' => 'Quản lý thuộc tính',
      'icon' => 'fa-tachometer',
      'route' => 'be.attribute.index'
  ],
  [
      'name' => 'Quản lý giá trị thuộc tính',
      'icon' => 'fa-tachometer',
      'route' => '#',
      'items' => [
          [
              'name' => 'Danh sách giá trị thuộc tính',
              'icon' => 'fa-circle nav-icon',
              'route' => 'be.attribute_value.index'
          ],
          [
              'name' => 'Thêm giá trị thuộc tính',
              'icon' => 'fa-circle nav-icon',
              'route' => 'be.attribute_value.create'
          ]
      ]
  ],
  [
      'name' => 'Starter Pages',
      'icon' => 'fa-tachometer',
      'route' => '#',
      'items' => [
          [
              'name' => 'Active Page',
              'icon' => 'fa-circle nav-icon',
              'route' => '#'
          ],
          [
              'name' => 'Inactive Page',
              'icon' => 'fa-circle nav-icon',
              'route' => '#'
          ]
      ]
  ],
];
?>
