<?php

namespace App\Models\_Base;

use DateTimeInterface;
use App\Exceptions\_Base\ItemNotFoundException;

/**
 * Class Affiliate
 *
 * @property integer $id
 * @property string  $api_key
 * @property string  $name
 * @property string  $slug
 */
trait BaseModelMethod
{
    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate( DateTimeInterface $date ): string
    {
        return $date->format( 'Y-m-d H:i:s' );
    }

//    /**
//     * @param array $data
//     * @return mixed
//     */
//    public static function store(array $data)
//    {
//        return self::create($data['data']);
//    }
//
//    /**
//     * @param $id
//     * @return mixed
//     */
//    public static function remove(array $data)
//    {
//        return self::where('id', $data['id'])->delete();
//    }
//
//    /**
//     * @param array $data
//     * @return mixed
//     */
//    public static function edit(array $data)
//    {
//        $item = self::show($data['id']);
//
//        if (method_exists(self::class, 'beforeUpdateFilter'))
//        {
//            self::beforeUpdateFilter($item, $data);
//        }
//
//        if ($item)
//        {
//            $options = isset($data['options']) ? $data['options'] : [];
//
//            $item->update($data['data'], $options);
//
//            if (method_exists(self::class, 'afterUpdate'))
//            {
//                self::afterUpdate($item, $data);
//            }
//        }
//
//        return $item;
//    }
//
//    /**
//     * @param string $method
//     * @param array $params
//     * @return mixed
//     */
//    public static function getQuery(string $method, array $params)
//    {
//        return self::$method($params);
//    }
//
//    /**
//     * @param int $id
//     * @param array $params
//     * @return mixed
//     */
//    public static function show(int $id, array $params = [])
//    {
//        $query = null;
//
//        if (isset($params['with']) && \count($params['with']))
//        {
//            $query = self::with($params['with']);
//        }
//
//        if (isset($params['inputs']))
//        {
//            $wheres = [];
//            $inputs = array_filter( (array)$params['inputs'] );
//
//            foreach ($inputs as $key => $val)
//            {
//                $permittedInputs = (new self())->searchable;
//
//                if ((is_numeric($key) && \is_array($val)) || \in_array($key, $permittedInputs, true))
//                {
//                    $wheres[$key] = $val;
//                }
//            }
//
//            if ($wheres)
//            {
//                $query = self::where($wheres);
//            }
//
//            if (isset($params['inputs']['with']))
//            {
//                $inputWiths = \is_array($params['inputs']['with']) ? $params['inputs']['with'] : explode(',', $params['inputs']['with']);
//                $query = self::with($inputWiths);
//            }
//        }
//
//        if (isset($params['wheres']))
//        {
//            foreach ($params['wheres'] as $where)
//            {
//                $query = $query ? $query->$where['method']($where['args']) : self::$where['method']($where['args']);
//            }
//        }
//
//        if (isset($params['havings']))
//        {
//            foreach ($params['havings'] as $having)
//            {
//                $query = $query ? $query->$having['method']($having['args']) : self::$having['method']($having['args']);
//            }
//        }
//
//        if (isset($params['columns']))
//        {
//            $columns = array_filter(\is_array($params['columns']) ? $params['columns'] : explode(',', $params['columns']));
//            $query = $query ? $query->select($columns) : self::select($columns);
//        }
//
//        if (isset($params['inputs']['columns']))
//        {
//            $inputColumns = explode(',', $params['inputs']['columns']);
//            $query = $query ? $query->select($inputColumns) : self::select($inputColumns);
//        }
//
//        if (isset($params['scopes']))
//        {
//            foreach ($params['scopes'] as $scope)
//            {
//                $query = $query ? $query->$scope() : self::$scope();
//            }
//        }
//
//        return $query ? $query->find($id) : self::find($id);
//
//    }
//
//    /**
//     * @param $collection
//     * @return array
//     */
//    private static function result_for_paginate($collection): array
//    {
//        return [
//            'items' => $collection->items(),
//            'page' => $collection->currentPage(),
//            'total' => $collection->total(),
//            'pages' => $collection->lastPage(),
//            'perPage' =>$collection->perPage()
//        ];
//    }

    /**
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function index( array $params = [] )
    {
        $query = self::query();

        if ( isset( $params[ 'wheres' ] ) )
        {
            $query->where( $params[ 'wheres' ] );
        }

        if ( method_exists( self::class, 'filterIndex' ) )
        {
            $filters = self::getNormalFilterInputs( request()->all() );

            $query = self::filterIndex( $query, $filters );
        }

        if ( method_exists( self::class, 'addAdvancedSearchToGetAll' ) )
        {
            $query = self::addAdvancedSearchToGetAll( $query, $params );
        }

        if ( isset( $params[ 'with' ] ) && is_array( $params[ 'with' ] ) )
        {
            $query->with( $params[ 'with' ] );
        }

        if ( isset( $params[ 'with_count' ] ) && is_array( $params[ 'with_count' ] ) )
        {
            $query->withCount( $params[ 'with_count' ] );
        }

        $orderBy = $params['order_by'] ?? 'id';
        $order = $params['order'] ?? 'desc';

        $query->orderBy( $orderBy, $order );

        $page = $params[ 'page' ] ?? 0;
        $perPage = (int)( $params[ 'per_page' ] ?? 15 );

        if ( $page < 0 )
        {
            return $query->get();
        }

        return $query->simplePaginate( $perPage );
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public static function show( int $id, array $params = [] )
    {
        $query = self::query();

        if ( isset( $params[ 'with' ] ) && is_array( $params[ 'with' ] ) )
        {
            $query->with( $params[ 'with' ] );
        }

        if (isset($params['inputs']))
        {
            $wheres = [];
            $inputs = array_filter( (array)$params['inputs'] );

            foreach ($inputs as $key => $val)
            {
                $permittedInputs = (new self())->searchable;

                if ((is_numeric($key) && \is_array($val)) || \in_array($key, $permittedInputs, true))
                {
                    $wheres[$key] = $val;
                }
            }

            if ($wheres)
            {
                $query = self::where($wheres);
            }

            if (isset($params['inputs']['with']))
            {
                $inputWiths = \is_array($params['inputs']['with']) ? $params['inputs']['with'] : explode(',', $params['inputs']['with']);
                $query = self::with($inputWiths);
            }
        }

        if ( isset( $params[ 'wheres' ] ) )
        {
            $query->where( $params[ 'wheres' ] );
        }

        if ( isset( $params[ 'with_count' ] ) && is_array( $params[ 'with_count' ] ) )
        {
            $query->withCount( $params[ 'with_count' ] );
        }

        return $query->find( $id );
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     * @throws ItemNotFoundException
     */
    public static function showOrFail( int $id, array $params = [] )
    {
        $item = self::show( $id, $params );

        if ( empty( $item ) )
        {
            throw new ItemNotFoundException();
        }

        return $item;
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public static function edit( $id, array $data )
    {
        $item = self::find( $id );

        if ( $item )
        {
            $item->update( $data );
        }

        return $item;
    }

    /**
     * @param $request
     * @return array|void
     */
    private static function getNormalFilterInputs( $request )
    {
        $result = [];

        if ( !empty( $request ) && is_array( $request ) )
        {
            foreach ( $request as $key => $item )
            {
                if ( is_string( $item ) )
                {
                    $result[$key] = [
                        'op' => '=',
                        'val' => $item
                    ];
                }
                elseif ( is_array( $item ) && isset( $item['op'], $item[ 'val' ] ) )
                {
                    $result[$key] = [
                        'op' => $item['op'],
                        'val' => $item[ 'val' ]
                    ];
                }
            }
        }

        return $result;
    }
}
