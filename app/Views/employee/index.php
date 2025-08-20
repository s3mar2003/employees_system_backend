<?php require __DIR__ . '/../inc/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">إدارة الموظفين</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="/employee-portal/public/employees/create" class="btn btn-primary">إضافة موظف جديد</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>القسم</th>
                <th>الوظيفة</th>
                <th>تاريخ التعيين</th>
                <th>الراتب</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($employees)): ?>
                <?php foreach ($employees as $index => $employee): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($employee['name']); ?></td>
                        <td><?php echo htmlspecialchars($employee['email']); ?></td>
                        <td><?php echo htmlspecialchars($employee['department']); ?></td>
                        <td><?php echo htmlspecialchars($employee['position']); ?></td>
                        <td><?php echo htmlspecialchars($employee['hire_date']); ?></td>
                        <td><?php echo htmlspecialchars($employee['salary']); ?></td>
                        <td>
                            <a href="/employee-portal/public/employees/edit/<?php echo $employee['id']; ?>" class="btn btn-warning btn-sm">تعديل</a>
                            <a href="/employee-portal/public/employees/delete/<?php echo $employee['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذا الموظف؟')">حذف</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">لا يوجد موظفين</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../inc/footer.php'; ?>