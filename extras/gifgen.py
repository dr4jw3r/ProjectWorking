radian_constant = 0.0174532925
total_rotation = 360
rotate_degree = 4
num_of_frames = total_rotation / rotate_degree
rotate_radians = rotate_degree * radian_constant
current_rotation = 0

image = gimp.image_list()[0]
layer = image.active_layer

for x in range(0, num_of_frames):
	current_rotation += rotate_radians
	print current_rotation
	layer_copy = layer.copy()
	layer_copy.name = "Frame %d" % x
	image.add_layer(layer_copy)
	pdb.gimp_drawable_transform_rotate(layer_copy, current_rotation, True, image.width/2, image.height/2, 0, 0, True, 3, 0)



