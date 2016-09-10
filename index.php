<?php
function pointInPolygon($point, $polygon)
{
    
    // check if the point sits exactly on a vertex
    foreach ($polygon as $vertex)
    {
        if ($point["x"] == $vertex["x"] && $point["y"] == $vertex["y"])
        {
            return true;
        }
    }
    
    // check if the point is inside the polygon or on the boundary
    $intersections  = 0;
    $vertices_count = count($polygon);
    
    for ($i = 1; $i < $vertices_count; $i++)
    {
        $vertex1 = $polygon[$i - 1];
        $vertex2 = $polygon[$i];
        // check if point is on an horizontal polygon boundary
        if ($vertex1['y'] == $vertex2['y'] && $vertex1['y'] == $point['y'] && $point['x'] > min($vertex1['x'], $vertex2['x']) && $point['x'] < max($vertex1['x'], $vertex2['x']))
        {
            return true;
        }
        if ($point['y'] > min($vertex1['y'], $vertex2['y']) && $point['y'] <= max($vertex1['y'], $vertex2['y']) && $point['x'] <= max($vertex1['x'], $vertex2['x']) && $vertex1['y'] != $vertex2['y'])
        {
            $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
            // check if point is on the polygon boundary (other than horizontal)
            if ($xinters == $point['x'])
            {
                return true;
            }
            if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters)
            {
                $intersections++;
            }
        }
    }
    // if the number of edges we passed through is odd, then it's in the polygon. 
    if ($intersections % 2 != 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}